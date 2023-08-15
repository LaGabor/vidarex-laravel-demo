<?php

namespace App\Http\Controllers;

use App\Models\QueryRepositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    function registerUser(string $name,string $email,int $role,string $password):User
    {
        return $this->userRepository->registerUser($name,$email,$role,$password);
    }
    function isEmailExist(string $email):bool
    {
        return $this->userRepository->isEmailExist($email);
    }

    function isNameExist(string $name):bool
    {
        return $this->userRepository->isUserNameExist($name);
    }

}
