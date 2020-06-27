<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;

class DiggingDeeperController extends Controller
{
    public function collections(){
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();

        //dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        $collection = collect($eloquentCollection->toArray());

//        dd(
//            get_class($eloquentCollection),
//            get_class($collection),
//            $collection
//        );

//        $result['first'] = $collection->first();
//        $result['last'] = $collection->last();

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');

//        $result['where']['count'] = $result['where']['data']->count();
//        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
//        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

//        $result['where_first'] = $collection
//            ->firstWhere('created_at','>','2020-04-17 21:15:03');

//        $result['map']['all'] = $collection->map(function (array $item){
//            $newItem =new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//
//            return $newItem;
//        });
//
//        $result['map']['not_exist'] = $result['map']['all']
//            ->where('exists','=', false)
//            ->values();

        //base variable will change (transform)
//        $collection->transform(function (array $item){
//            $newItem =new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//            $newItem->created_at = Carbon::parse($item['created_at']);
//
//            return $newItem;
//        });

//        $newItem = new \stdClass();
//        $newItem->id = 9999;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 888;

//        $collection->prepend($newItem); // in front
//        $collection->push($newItem2); // in the end
//
//        dd($newItem, $newItem2, $collection);

        //set item to top of collection
//        $nameItemFirst = $collection->prepend($newItem);
//        $nameItemLast = $collection->push($newItem2);
//        $pooledItem = $collection->pull(1);
//
//        dd(compact('collection', 'nameItemFirst', 'nameItemLast','pooledItem'));

        //filtration. Replacing orWhere ()
//        $filtered = $collection->filter(function ($item){
//            $byDay = $item->created_at->isFriday();
//            $byDate = $item->created_at->day == 10;
//
//            $result = $byDay && $byDate;
//
//            return $result;
//        });
//
//        dd(compact('filtered'));

        $sortedSimpleCollection = collect([5, 3, 6, 2, 7])->sort()->values();
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        dd(compact('sortedSimpleCollection',
        'sortedAscCollection',
        'sortedDescCollection'));

    }
}
