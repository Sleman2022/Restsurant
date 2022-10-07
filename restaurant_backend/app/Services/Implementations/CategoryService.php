<?php


namespace App\Services\Implementations;

use App\Common\helper;
use App\Models\Category;
use App\Services\Interfaces\ICategoryService;
use Illuminate\Database\Eloquent\Collection;

class CategoryService implements ICategoryService
{
    public function __construct()
    {
    }

    public function getCategories()
    {
        return Category::paginate();
    }

    public function rootCategories()
    {
        return Category::whereNull('parent_id')->get();
    }
    public function newCategory($request)
    {
        $category = new Category();
        $category->name = $request->name;
        if($request->parent_id)
        {
            $category->parent_id = $request->parent_id;
        }
        $check = $category->save();
        return $check;
    }

    public function getParentCategories()
    {
        $categories = Category::all();
        $parent_categories = new Collection();
        foreach($categories as $category)
        {
            if((helper::categoryLevel($category)<4)&&(helper::noItemsChildren($category)))
            {
                $parent_categories->add($category);
            }
        }
        return $parent_categories;
    }

    public function deleteCategoryItem($id)
    {
        $category = Category::find($id);
        return $category->delete();
    }

    public function changeDiscount($request)
    {
        $category = Category::find($request->id);
        if($category)
        {
            $category->discount = $request->discount;
            return $category->save();
        }
        return false;
    }

    public function updateCategory($request)
    {
        $category = Category::find($request->id);
        if($category)
        {
            $category->name = $request->name;
            if($request->parent_id)
            {
                $category->parent_id = $request->parent_id;
            }
            return $category->save();
        }
        return false;
    }

    //
    public function getLeafCategories()
    {
        $categories = Category::get();
        $leaf_categories = new Collection();
        foreach($categories as $category)
        {
            if(helper::noCategoryChildren($category))
            {
                $leaf_categories->add($category);
            }
        }
        return $leaf_categories;
    }
    //
    public function subCategoriesItems($id)
    {
        return Category::where('parent_id',$id)->get();
    }
}
