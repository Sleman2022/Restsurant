<?php

namespace App\Http\Resources\Categories;

use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class CategoriesShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent_name = '';
        if($this->parent_id)
        {
            $parent_name = Category::find($this->parent_id)->name;
        }
        $discount = $this->discount;
        $parent_id = $this->parent_id;
        if(!$this->discount)
        {
            while(($parent_id) && (!$discount))
            {
                $temp_cat = Category::find($parent_id);
                $parent_id = $temp_cat->parent_id;
                $discount = $temp_cat->discount;
            }
        }
        if((!$discount) && (Session::has('token')))
        {
            $token = Session::get('token');
            $menu_id = User::where('remember_token',$token)->first()->menu_id;
            if($menu_id)
            {
                $discount = Menu::find($menu_id)->discount;
            }
            else
            {
                $discount = Menu::find(1)->discount;
            }

        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'discount' => $discount,
            'parent_id' => $this->parent_id,
            'parent_name' => $parent_name,
        ];
    }
}
