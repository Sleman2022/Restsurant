<?php


namespace App\Services\Implementations;

use App\Models\Category;
use App\Models\Category_Menu;
use App\Models\Menu;
use App\Models\User;
use App\Services\Interfaces\IMenuService;
use App\Services\Interfaces\IUsersService;
use Illuminate\Support\Collection;

class MenusService implements IMenuService
{
    public function __construct()
    {
    }

    public function getMenus()
    {
        return Menu::paginate();
    }

    public function newMenus($request)
    {
        $menu = new Menu();
        $menu->name = $request->name;
        $check = $menu->save();
        if($check)
        {
            foreach($request->users as $user)
            {
                $my_user = User::find($user);
                $my_user->menu_id = $menu->id;
                $my_user->save();
            }
            foreach($request->categories as $category)
            {
                $category_menu = new Category_Menu();
                $category_menu->menu_id = $menu->id;
                $category_menu->category_id = $category;
                $category_menu->save();
            }
        }
        return $check;
    }

    public function deleteMenu($id)
    {
        $users = User::where('menu_id',$id)->get();
        foreach($users as $user)
        {
            $user->menu_id = null;
            $user->save();
        }
        $menu = Menu::find($id);
        return $menu->delete();
    }

    public function changeDiscount($request)
    {
        $menu = Menu::find($request->id);
        if($menu)
        {
            $menu->discount = $request->discount;
            return $menu->save();
        }
        return false;
    }

    public function updateMenu($request)
    {
        $users = User::where('menu_id',$request->id)->get();
        foreach($users as $user)
        {
            $user->menu_id = null;
            $user->save();
        }
        foreach($request->users as $one_user)
        {
            if(is_int($one_user))
            {
                $temp_user = User::find($one_user);
                if($temp_user)
                {
                    $temp_user->menu_id = $request->id;
                    $temp_user->save();
                }
            }
        }
        $menu = Menu::find($request->id);
        if($menu)
        {
            $menu->name = $request->name;
            return $menu->save();
        }
        return false;
    }
    public function menuRootCategories($token)
    {
        $user = User::where('remember_token',$token)->first();
        if($user->menu_id)
        {
            $categoriesCollection = new Collection();
            $categories_menus = Category_Menu::where('menu_id', $user->menu_id)->get();
            foreach ($categories_menus as $categories_menu) {
                $category = Category::find($categories_menu->category_id);
                $categoriesCollection->add($category);
            }
            return $categoriesCollection;
        }
        else
        {
           return  $categories = Category::whereNull('parent_id')->get();
        }
    }
}
