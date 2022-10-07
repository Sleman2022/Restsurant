<?php

namespace App\Http\Resources\Menus;

use App\Http\Resources\UsersResources\UsersResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

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
        if($this->id == 1)
        {
           $users = UsersResource::collection(User::whereNull('menu_id')->get());
        }
        else
        {
            $users = UsersResource::collection(User::where('menu_id',$this->id)->get());
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'discount' => $this->discount,
            'users' => $users,
        ];
    }
}
