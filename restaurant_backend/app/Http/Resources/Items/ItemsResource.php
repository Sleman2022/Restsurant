<?php

namespace App\Http\Resources\Items;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemsResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'discount' => $this->discount,
            'parent_id' => $this->parent_id,
            'parent_name' => $parent_name,
            'price' => $this->price,
        ];
    }
}
