<?php

namespace App\Http\Controllers;

use App\Http\Resources\Categories\CategoriesResource;
use App\Services\Implementations\CategoryService;
use App\Services\Interfaces\ICategoryService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    /**
     * @var ICategoryService
     */
    private $CategoryService;
    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }

    //
    public function index(){
        return CategoriesResource::collection($this->CategoryService->getCategories());
    }

    //
    public function newCategory(Request $request)
    {
        if($this->CategoryService->newCategory($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'category added successfully',
                'data' => null
            ],200);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Something went wrong',
            'data' => null
        ],400);
    }

    //
    public function parentCategories()
    {
        return CategoriesResource::collection($this->CategoryService->getCategories());
//        return CategoriesResource::collection($this->CategoryService->getParentCategories());
    }

    //
    public function deleteCategory(Request $request)
    {
        if($this->CategoryService->deleteCategoryItem($request->id))
        {
            return response()->json([
                'status' => 200,
                'message' => 'category deleted successfully',
                'data' => null
            ],200);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Something went wrong',
            'data' => null
        ],400);
    }
    //
    public function changeDiscount(Request $request)
    {
        if($this->CategoryService->changeDiscount($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'Category updated successfully',
                'data' => null
            ],200);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Something went wrong',
            'data' => null
        ],400);
    }
    //
    public function updateCategory(Request $request)
    {
        if($this->CategoryService->updateCategory($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'Category deleted successfully',
                'data' => null
            ],200);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Something went wrong',
            'data' => null
        ],400);
    }
}
