<?php


namespace App\Services\Interfaces;


interface ICategoryService
{
    public function getCategories();
    public function newCategory($request);
    public function deleteCategoryItem($id);
    public function changeDiscount($request);
    public function updateCategory($request);
    public function getParentCategories();
}