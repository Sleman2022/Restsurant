<?php


namespace App\Services\Interfaces;


interface IUsersService
{
    public function getUsers();
    public function changeRole($id,$role);
    public function noMenuUsers();
}
