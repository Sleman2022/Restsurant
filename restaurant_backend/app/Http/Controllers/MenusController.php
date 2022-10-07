<?php

namespace App\Http\Controllers;

use App\Http\Resources\Menus\MenusResource;
use App\Services\Interfaces\IMenuService;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    //
    /**
     * @var IMenuService
     */
    private $MenuService;
    public function __construct(IMenuService $MenuService)
    {
        $this->MenuService = $MenuService;
    }

    //
    public function index(){
        return MenusResource::collection($this->MenuService->getMenus());
    }

    //
    public function newMenu(Request $request)
    {
        if($this->MenuService->newMenus($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'menu added successfully',
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
    public function updateMenu(Request $request)
    {
        if($this->MenuService->updateMenu($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'menu deleted successfully',
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
        if($this->MenuService->changeDiscount($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'menu updated successfully',
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
    public function deleteMenu(Request $request)
    {
        if($this->MenuService->deleteMenu($request->id))
        {
            return response()->json([
                'status' => 200,
                'message' => 'menu deleted successfully',
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
