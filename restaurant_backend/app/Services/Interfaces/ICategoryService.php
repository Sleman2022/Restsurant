<?php


namespace App\Services\Interfaces;


interface ICategoryService
{
    public function getCategories();
    public function rootCategories();
    public function newCategory($request);
    public function deleteCategoryItem($id);
    public function changeDiscount($request);
    public function updateCategory($request);
    public function getParentCategories();
    public function getLeafCategories();
    public function subCategoriesItems($id);
}
