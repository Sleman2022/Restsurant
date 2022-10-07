<?php

namespace App\Http\Controllers;

use App\Http\Resources\Items\ItemsResource;
use App\Services\Interfaces\IItemService;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * @var IItemService
     */
    private $ItemService;
    public function __construct(IItemService $ItemService)
    {
        $this->ItemService = $ItemService;
    }

    //
    public function index(){
        return ItemsResource::collection($this->ItemService->getItems());
    }

    //
    public function deleteItem(Request $request)
    {
        if($this->ItemService->deleteItem($request->id))
        {
            return response()->json([
                'status' => 200,
                'message' => 'Item deleted successfully',
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
        if($this->ItemService->changeDiscount($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'Item updated successfully',
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
    public function updateItem(Request $request)
    {
        if($this->ItemService->updateItem($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'Item updated successfully',
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
    public function newItem(Request $request)
    {
        if($this->ItemService->newItem($request))
        {
            return response()->json([
                'status' => 200,
                'message' => 'item added successfully',
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
