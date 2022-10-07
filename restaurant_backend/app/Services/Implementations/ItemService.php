<?php


namespace App\Services\Implementations;

use App\Models\Item;
use App\Services\Interfaces\IItemService;

class ItemService implements IItemService
{
    public function __construct()
    {
    }

    public function getItems()
    {
        return Item::paginate();
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        return $item->delete();
    }

    public function changeDiscount($request)
    {
        $item = Item::find($request->id);
        if($item)
        {
            $item->discount = $request->discount;
            return $item->save();
        }
        return false;
    }

    public function updateItem($request)
    {
        $item = Item::find($request->id);
        if($item)
        {
            $item->name = $request->name;
            $item->parent_id = $request->parent_id;
            $item->price = $request->price;
            return $item->save();
        }
        return false;
    }

    public function newItem($request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->parent_id = $request->parent_id;
        $item->price = $request->price;
        $check = $item->save();
        return $check;
    }

    //
    public function subCategoriesItems($id)
    {
        return Item::where('parent_id',$id)->get();
    }
}
