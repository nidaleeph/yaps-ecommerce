<?php

namespace App\Http\Controllers;

use App\Models\CategoryWatch;
use App\Models\Watch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
// use App\Models\Events;


class WatchController extends Controller
{
    public function index()
    {
        $query = Watch::query();
            // ->orderBy('updated_at', 'desc');
        return $this->renderWatch($query);

    }

    public function byCategory(CategoryWatch $categoryWatch)
    {
        $categoriesWatch = CategoryWatch::getAllChildrenByParent($categoryWatch);
        $query = Watch::query()
            ->select('watches.*')
            ->join('watch_categories AS wc', 'wc.watch_id', 'watches.id')
            ->orderBy('updated_at', 'desc')
            ->whereIn('wc.category_watch_id', array_map(fn($wc) => $wc->id, $categoriesWatch));

        return $this->renderWatch($query);
    }

    public function view(Watch $watch)
    {
        // $existingActiveEvent = Events::where('active', 1)->first();
        $url = null;
        if(str_contains($watch->url,'youtu.be/')){
            $url = explode('youtu.be/',$watch->url);
            if(str_contains(end($url),'?list')){
                $url = explode('?list',end($url));
                $url = 'https://www.youtube.com/embed/'.reset($url);
            }else{
                $url = 'https://www.youtube.com/embed/'.end($url);
            }
            $watch->url = $url;
        }
        elseif(str_contains($watch->url,'watch?v=')){

            $url = explode('watch?v=',$watch->url);
            if(str_contains(end($url),'&list')){

                $url = explode('&list',end($url));
                $url = 'https://www.youtube.com/embed/'.reset($url);
            }else{
                $url = 'https://www.youtube.com/embed/'.end($url);
            }
            $watch->url = $url;
        }

        return view('watch.view', ['watch' => $watch]);
    }

    private function renderWatch(Builder $query)
    {
        $search = \request()->get('search');
        $sort = \request()->get('sort', '-updated_at');


        if ($sort) {
            $sortDirection = 'asc';
            if ($sort[0] === '-') {
                $sortDirection = 'desc';
            }
            $sortField = preg_replace('/^-?/', '', $sort);
            $query->orderBy($sortField, $sortDirection);
        }

        $watch = $query
            ->where('published', '=', 1)
            ->where(function ($query) use ($search) {
                /** @var $query \Illuminate\Database\Eloquent\Builder */
                $query->where('watches.title', 'like', "%$search%")
                    ->orWhere('watches.description', 'like', "%$search%")
                    ->orWhere('watches.watch_code', 'like', "%$search%");
            })

            ->paginate(12);
        return view('watch.index', [
            'watch' => $watch,
        ]);

    }
}
