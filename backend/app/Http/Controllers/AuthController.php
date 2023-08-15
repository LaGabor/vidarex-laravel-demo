<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(private UserController $userController)
    {
    }

    public function register( Request $request){

        if(! $this->validateRegister($request)){
            return response(['warning' => ["Wrong credentials!"]], Response::HTTP_OK);
        };
        $role = $this->validateRole($request->role);
        $encryptedPassword = bcrypt($request->password);
        $user = $this->userController->registerUser($request->name,$request->email,$role,$encryptedPassword);


        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' =>$token,
            'Type' => 'Bearer',
            'role' => $user->role,
            'name' => $user->name
        ]);
    }

    public function login(Request $request)
    {
        if(! $this->isNameAndPasswordValid($request->name,$request->password)){
            return response(['warning' => ["Wrong credentials!"]], Response::HTTP_OK);
        }

        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['warning' => ["Wrong credentials!"]], Response::HTTP_OK);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $user->role,
            'name' => $user->name
        ]);
    }
    public function notAuthenticated():Response{
        return response(['warning' => ["Not Authenticated!"]], Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED);
    }

    private function isEmailExist(string $email):bool{
        return $this->userController->isEmailExist($email);
    }

    private function isNameExist(string $name):bool{
       return $this->userController->isNameExist($name);
    }

    private function validateRole($role):int{
        return $role === 1?1:0;
    }

    private function isNameAndPasswordValid($name,$password ):bool{

        if(is_string($name) && is_string($password)){
            if(trim($name) !== '' && trim($password) !== ''){
                    return true;
            }
        }
        return false;
    }

    private function isEmailFormat(string $email):bool{
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    private function validateRegister(Request $request){
        if($this->isNameAndPasswordValid($request->name,$request->password)){
            if($this->isEmailFormat($request->email) && ! $this->isEmailExist($request->email)){
                if(! $this->isNameExist($request->name)){
                    return true;
                }
            }
        }
        return false;
    }
}
