<?php


namespace App\Services\Implementations;

use App\Models\User;
use App\Services\Interfaces\IUsersService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UsersService implements IUsersService
{
    public function __construct()
    {
    }

    public function getUsers()
    {
        return User::paginate();
    }

    public function changeRole($id,$role)
    {
        $user = User::find($id);
        if($user)
        {
            $user->role = $role;
            $user->save();
            return $user->save();
        }
        return false;
    }

    public function noMenuUsers()
    {
        return User::whereNull('menu_id')->get();
    }
}
