<?php


namespace App\Services\Interfaces;


interface IItemService
{
    public function getItems();
    public function changeDiscount($request);
    public function deleteItem($id);
    public function updateItem($request);
    public function newItem($request);
}
