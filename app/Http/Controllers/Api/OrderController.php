<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderListResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductListResource;
use App\Mail\OrderUpdateEmail;
use App\Models\Api\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Order::query()
            ->withCount('items')
            ->with('user.customer')
            ->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('total_price', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return OrderListResource::collection($query);
    }   

    public function view(Order $order)
    {
        $order->load('items.product', 'items.events');
        return new OrderResource($order);
    }

    public function getStatuses()
    {
        return OrderStatus::getStatuses();
    }

    public function changeStatus(Order $order, $status)
    {
        DB::beginTransaction();
        try {
            if ($status === OrderStatus::Cancelled->value && $order->status !== 'returned') {
                foreach ($order->items as $item) {
                    $product = $item->product;
                    if ($product && $product->quantity !== null) {
                        $product->quantity += $item->quantity;
                        $product->save();
                    }
                }
            }
            else if ($status === OrderStatus::Returned->value && $order->status !== 'cancelled') {
                foreach ($order->items as $item) {
                    $product = $item->product;
                    if ($product && $product->quantity !== null) {
                        $product->quantity += $item->quantity;
                        $product->save();
                    }
                }
            }
            else if ($status === OrderStatus::Unpaid->value && $order->status !== 'paid') {
                foreach ($order->items as $item) {
                    $product = $item->product;
                    if ($product && $product->quantity !== null) {
                        $product->quantity -= $item->quantity;
                        if($product->quantity < 0){
                            return response([
                                'message' => $product->title. ' is out of stock',
                                'failed' => true
                            ], 200);
                        }
                        $product->save();
                    }
                }
            }
            else if ($status === OrderStatus::Paid->value && $order->status !== 'unpaid') {
                foreach ($order->items as $item) {
                    $product = $item->product;
                    if ($product && $product->quantity !== null) {
                        $product->quantity -= $item->quantity;
                        if($product->quantity < 0){
                            return response([
                                'message' => $product->title. ' is out of stock',
                                'failed' => true
                            ], 200);
                        }
                        $product->save();
                    }
                }
            }

            $order->status = $status;
            $order->save();
            // Mail::to($order->user)->send(new OrderUpdateEmail($order));
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return response('', 200);
    }
    public function printOrder(Request $request, $id){
        $user = User::where('is_admin',1)->first();
        $order = Order::with(['items','user','items.product'])->find($id);
        return view('order.print', compact(['order','user']));
    }
}
