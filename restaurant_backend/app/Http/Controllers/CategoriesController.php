<?php

namespace App\Http\Controllers;

use App\Http\Resources\Categories\CategoriesResource;
use App\Http\Resources\Categories\CategoriesShowResource;
use App\Http\Resources\Items\ItemsResource;
use App\Http\Resources\Items\ItemsShowResource;
use App\Services\Implementations\CategoryService;
use App\Services\Implementations\ItemService;
use App\Services\Interfaces\ICategoryService;
use App\Services\Interfaces\IMenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * @var ICategoryService
     */
    private $CategoryService;

    /**
     * @var IMenuService
     */
    private $MenuService;
    /**
     * @var ItemService
     */
    private $ItemService;

    public function __construct(CategoryService $CategoryService ,IMenuService $MenuService,ItemService $ItemService)
    {
        $this->CategoryService = $CategoryService;
        $this->MenuService = $MenuService;
        $this->ItemService = $ItemService;
    }

    //
    public function index(){
        return CategoriesResource::collection($this->CategoryService->getCategories());
    }
    //
    public function rootCategories(){
        return CategoriesResource::collection($this->CategoryService->rootCategories());
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
        return CategoriesResource::collection($this->CategoryService->getParentCategories());
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
    //
    public function LeafCategories()
    {
        return CategoriesResource::collection($this->CategoryService->getLeafCategories());
    }
    //
    public function menuRootCategories(Request $request)
    {
        return CategoriesResource::collection($this->MenuService->menuRootCategories($request->token));
    }
    //
    public function subCategoriesItems(Request $request)
    {
        Session::put('token',$request->token);
        return $data =
            [
                'categories' => CategoriesShowResource::collection($this->CategoryService->subCategoriesItems($request->id)),
                'items' => ItemsShowResource::collection($this->ItemService->subCategoriesItems($request->id)),
            ];
    }
}
