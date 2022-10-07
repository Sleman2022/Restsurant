<?php


namespace App\Services\Interfaces;


interface IMenuService
{
    public function getMenus();
    public function newMenus($request);
    public function deleteMenu($id);
    public function changeDiscount($request);
    public function updateMenu($request);
    public function menuRootCategories($token);
}
