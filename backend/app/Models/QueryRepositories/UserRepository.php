<?php

namespace App\Models\QueryRepositories;

use App\Models\User;

class UserRepository
{
    public function isUserNameExist($userName):bool{
        return User::where('name', $userName)->exists();
    }

    public function isEmailExist($email):bool{
        return User::where('email', $email)->exists();
    }

    public function registerUser(string $name,string $email,int $role,string $password):User{
        return User::create([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password'=>$password,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

}
