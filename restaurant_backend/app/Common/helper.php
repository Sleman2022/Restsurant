<?php


namespace App\Common;


use App\Models\Category;
use App\Models\Item;

class helper
{
  public static function categoryLevel($category)
  {
      return helper::countCategoryLevel($category,1);
  }

  public static function countCategoryLevel($category,$level)
  {
     if(!$category->parent_id)
     {
         return $level;
     }
     else
     {
         $parent_category = Category::find($category->parent_id);
         return helper::countCategoryLevel($parent_category,$level+1);
     }
  }

  public static function noItemsChildren($category)
  {
      $items = Item::where('parent_id',$category->id)->get();
      return !count($items);
  }

    public static function noCategoryChildren($category)
    {
        $category = Category::where('parent_id',$category->id)->get();
        return !count($category);
    }
}
