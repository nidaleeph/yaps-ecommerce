<?php

namespace App\Http\Controllers\Api;

use App\Enums\AddressType;
use App\Enums\CustomerStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\OrderResource;
use App\Models\Customer;
use App\Models\User;
use App\Models\Events;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Traits\ReportTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\GlobalHelpers;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    use ReportTrait;

    public function activeCustomers()
    {
        return Customer::where('status', CustomerStatus::Active->value)->count();
    }

    public function activeProducts()
    {
        return Product::where('published', '=', 1)->count();
    }

    public function paidOrders()
    {
        $fromDate = $this->getFromDate();
        $query = Order::query()->where('status', OrderStatus::Paid->value);

        // if ($fromDate) {
        //     $query->where('created_at', '>', $fromDate);
        // }

        $dateRange = json_decode($this->dateRange());
        if ($dateRange) {
            $query->whereDate('created_at', '>=', $dateRange->startDate)
                ->whereDate('created_at', '<=', $dateRange->endDate);
        }


        return $query->count();
    }

    public function totalIncome()
    {
        $fromDate = $this->getFromDate();
        $query = Order::query()->where('status', OrderStatus::Paid->value);

        // if ($fromDate) {
        //     $query->where('created_at', '>', $fromDate);
        // }
        $dateRange = json_decode($this->dateRange());
        if ($dateRange) {
            $query->whereDate('created_at', '>=', $dateRange->startDate)
                ->whereDate('created_at', '<=', $dateRange->endDate);
        }
        return round($query->sum('total_price'));
    }

    public function allTimeTotalIncome()
    {
        $productSum = Product::where('published', true)->get()->sum(function ($product) {
            return $product->price * $product->quantity;
        });

        $query = Order::query()->whereIn('status', [OrderStatus::Paid->value,OrderStatus::Unpaid->value]);
        return round($query->sum('total_price')) + $productSum;
    }

    public function ordersByCategory()
    {
        $fromDate = $this->getFromDate();

        $dateRange =  json_decode($this->dateRange());

        // $query = Order::query()
        //     ->select(['c.name', DB::raw('count(orders.id) as count')])
        //     ->join('users', 'created_by', '=', 'users.id')
        //     ->join('customer_addresses AS a', 'users.id', '=', 'a.customer_id')
        //     ->join('countries AS c', 'a.country_code', '=', 'c.code')
        //     ->where('status', OrderStatus::Paid->value)
        //     ->where('a.type', AddressType::Billing->value)
        //     ->groupBy('c.name')
        //     ;

        $query = Order::query()
    ->select([
        'd.name',
        DB::raw('count(orders.id) as per_order'),
        DB::raw('sum(a.quantity) as count'),
        DB::raw('ROUND(SUM(CASE WHEN events.id IS NOT NULL THEN ((p.price - (p.price * (events.percentage/100))) * a.quantity) ELSE (p.price * a.quantity) END), 2) as price_per_category'),
    ])
    ->join('users', 'created_by', '=', 'users.id')
    ->join('order_items AS a', 'orders.id', '=', 'a.order_id')
    ->join('product_categories AS c', 'a.product_id', '=', 'c.product_id')
    ->join('categories AS d', 'c.category_id', '=', 'd.id')
    ->join('products AS p', 'a.product_id', '=', 'p.id') // Join the products table
    ->leftJoin('events', 'a.eventId', '=', 'events.id') // Use leftJoin instead of join for 'events'
    ->where('status', OrderStatus::Paid->value)
    ->groupBy('d.name');

        
    
        // if ($fromDate) {
        //     $query->where('orders.created_at', '>', $fromDate);
        // }

        $dateRange = json_decode($this->dateRange());
        if ($dateRange) {
            $query->whereDate('orders.created_at', '>=', $dateRange->startDate)
                ->whereDate('orders.created_at', '<=', $dateRange->endDate);
        }

        return $query->get();
    }

    public function latestCustomers()
    {
        return Customer::query()
            ->select(['id', 'first_name', 'last_name', 'u.email', 'phone', 'u.created_at'])
            ->join('users AS u', 'u.id', '=', 'customers.user_id')
            ->where('status', CustomerStatus::Active->value)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function latestOrders()
    {
        return OrderResource::collection(
            Order::query()
                ->select(['o.id', 'o.total_price', 'o.created_at', DB::raw('COUNT(oi.id) AS items'),
                    'c.user_id', 'c.first_name', 'c.last_name'])
                ->from('orders AS o')
                ->join('order_items AS oi', 'oi.order_id', '=', 'o.id')
                ->join('customers AS c', 'c.user_id', '=', 'o.created_by')
                ->where('o.status', OrderStatus::Paid->value)
                ->limit(10)
                ->orderBy('o.created_at', 'desc')
                ->groupBy('o.id', 'o.total_price', 'o.created_at', 'c.user_id', 'c.first_name', 'c.last_name')
                ->get()
        );
    }

    public function downloadCsv(Request $request)
    {
        $query = Order::select([
            'categories.name as category',
            'users.name as customerName',
            'a.product_code as productCode',
            'a.title as productName',
            'a.price as productPrice',
            'b.quantity as totalQuantity',
            \DB::raw('COALESCE(events.name, null) as discountName'),
            \DB::raw('COALESCE(events.percentage, null) as discountPercentage'),
            'orders.id as orderId',
            \DB::raw('CASE WHEN events.percentage IS NOT NULL THEN (a.price - (a.price * (events.percentage/100))) * b.quantity ELSE a.price * b.quantity END as totalPrice'),
            \DB::raw("DATE_FORMAT(orders.updated_at, '%M %e, %Y') as date")
        ])
            ->join('order_items AS b', 'orders.id', '=', 'b.order_id')
            ->join('products AS a', 'b.product_id', '=', 'a.id')
            ->join('product_categories AS c', 'a.id', '=', 'c.product_id')
            ->join('categories', 'c.category_id', '=', 'categories.id')
            ->join('users', 'orders.created_by', '=', 'users.id')
            ->leftJoin('events', 'b.eventId', '=', 'events.id') // Use leftJoin instead of join for 'events'
            ->where('orders.status', OrderStatus::Paid->value)
            ->orderBy('orders.updated_at', 'ASC');
        
                 
        
        // Execute the query and retrieve the results

        if($request->startDate && $request->endDate){
            $query->whereDate('orders.created_at', '>=', $request->startDate)
                ->whereDate('orders.created_at', '<=', $request->endDate);
        }
        $results = $query->get();
        
        // Convert the results to a JSON response
        // return response()->json($results);
        

        // return $orders;
        $totalPriceSum = 0;

        $data = [];

        foreach ($results as $item) {
            array_push($data, [
                $item->date,
                $item->orderId,
                $item->customerName,
                $item->productCode,
                $item->productName,
                $item->productPrice,
                $item->category,
                $item->totalQuantity,
                $item->discountName ? $item->discountName: '',
                $item->discountPercentage ?  $item->discountPercentage.'%' : '',
                $item->totalPrice,
            ]);
    
            $totalPriceSum += $item->totalPrice; // Calculate the sum of totalPrice
        }
        array_push($data,[
           "",
           "",
           "",
           "",
           "",
           "",
           "",
           "",
           "",
           "",
           "",
           "Total Sum = ". $totalPriceSum
        ]);
        $headers = [[
            'Date',
            'Order #',
            'Customer',
            'Product Code',
            'Product Name',
            'Product Price',
            'Category',
            'Quantity',
            'Discount Event',
            'Discount Percentage',
            'Total Price',
        ]];


        $path = GlobalHelpers::generateCsv([
            'header' => $headers,
            'data' => $data,
            'filename' => 'Date-' .'from='.$request->startDate.'to='.$request->endDate .'-'.time() . '.csv',
            'path' => '/exports/reports/csv/',
        ]);

        $fileName = 'Date-' .'from='.$request->startDate.'to='.$request->endDate .'-'.time() . '.csv';

        $path = storage_path('app/exports/reports/csv/'.$fileName);

        $response = response()->download($path, $fileName);

        return $response;

    }

    public function allItemPrice(){
        return Product::where('published', true)->get()->sum(function ($product) {
            return $product->price * $product->quantity;
        });
    }

    public function getActiveEvent(){
        $existingActiveEvent = Events::where('active', 1)->first();
        return $existingActiveEvent;
    }
}
