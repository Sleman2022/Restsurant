<?php

namespace App\Http\Resources\Menus;

use App\Http\Resources\UsersResources\UsersResource;
use App\Models\Category;
use App\Models\Category_Menu;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class MenusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $categoriesCollection = new Collection();
        if($this->id == 1)
        {
           $users = UsersResource::collection(User::whereNull('menu_id')->get());
           $categories = Category::whereNull('parent_id')->get();
           foreach($categories as $category)
           {
               $categoriesCollection->add($category->name);
           }
        }
        else {
            $users = UsersResource::collection(User::where('menu_id', $this->id)->get());
            $categories_menus = Category_Menu::where('menu_id', $this->id)->get();
            foreach ($categories_menus as $categories_menu) {
                $category = Category::find($categories_menu->category_id);
                $categoriesCollection->add($category->name);
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'discount' => $this->discount,
            'users' => $users,
            'categories' => $categoriesCollection,
        ];
    }
}
