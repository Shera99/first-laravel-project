<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        /**
         * @var Collection $elequentCollections
         */
        $elequentCollections = BlogPost::withTrashed()->get();

//        $first[] = $elequentCollections->first();
//        dd(__METHOD__, $elequentCollections, $elequentCollections->toArray());

        /**
         * @var \Illuminate\Support\Collection $collections
         */
        $collections = collect($elequentCollections->toArray());

//        dd(get_class($elequentCollections), get_class($collections), $collections);
//
//        $result['first'] = $collections->first();
//        $result['last'] = $collections->last();

        /*$result['where']['data'] = $collections
            ->where('category_id','<',3)
            ->values()                                  // Берет данные а ключи нет
            ->keyBy('slug');                        // Берет id из записи и делает его ключом
        */
//        $result['where']['count'] = $result['where']['data']->count();
//        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
//        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();
//
//        $result['first_where'] = $collections->firstWhere('id', '>', 90);

          /**
           * map - Создает новую и оставляет старую
           * transform - Меняет нынешнюю
           */

//        $result['map']['all'] = $collections->map(function ($item) {
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->new_slug = $item['slug'];
//            $newItem->exists = is_null($item['deleted_at']);
//
//            return $newItem;
//        });
//
//        $result['map']['exist'] = $result['map']['all']->where('exists', '=', false)->values()->keyBy('item_id');

        $result['transform'] = $collections->transform(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->new_slug = $item['slug'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });

//        $newItem = new \stdClass();
//        $newItem->item_id = 9999;
//
//        $new1 = new \stdClass();
//        $new1->item_id = 8888;

//        $collections->prepend($newItem);  -- Добавить в начало
//        $collections->push($new1);        -- Добавить в конец
//        $collections->pull(1);            -- Вырезать элемент

//        $itemFirst = $collections->prepend($newItem)->first();
//        $itemLast = $collections->push($new1)->last();
//        $itemCut = $collections->pull(1);

        //$result['filter']
//         $filtered = $collections->filter(function ($item) {
//            $byDay = $item->created_at->isFriday();
//            $byDate = $item->created_at->day == 12;
//
//            $result = $byDay && $byDate;
//
//            return $result;
//        });
//        dd(compact('filtered'));

        $result['newCollection'] = collect([4,1,1,2.2,2.1,2,5,1,6,8,0])->sort()->values();
        $result['sortByCollections'] = $collections->sortBy('created_at');
        $result['sortByDescCollections'] = $collections->sortByDesc('item_id');

        dd($result);
    }
}
