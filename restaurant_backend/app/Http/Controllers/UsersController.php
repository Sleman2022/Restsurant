<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResources\UsersResource;
use App\Models\User;
use App\Services\Interfaces\IUsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var IUsersService
     */
    private $UsersService;
    public function __construct(IUsersService $UsersService)
    {
        $this->UsersService = $UsersService;
    }

    //
    public function index(){
        return UsersResource::collection($this->UsersService->getUsers());
    }

    //
    public function change_role(Request $request)
    {
        if($this->UsersService->changeRole($request->id,$request->role))
        {
            return response()->json([
                'status' => 200,
                'message' => 'role changed successfully',
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
    public function noMenuUsers(){
        return UsersResource::collection($this->UsersService->noMenuUsers());
    }
}
