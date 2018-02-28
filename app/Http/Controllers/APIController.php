<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;


class APIController extends Controller
{
    public function login(Request $request){
        $input = $request::all();
        if(Auth::attempt(['email' => $input['email'],'password' => $input['password']])){
            $user =  User::where('email',$input['email'])->first();
            if($user->status){
                if($user->role != 'Waiter'){
                    $response = [
                        'success' => false,
                        'message' => 'Role not authorized for this action!'
                    ];
                }else{
                    $response = [
                        'success' => true,
                        'message' => 'User Logged In!',
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'username' => $user->username,
                            'email' => $user->email,
                            'phone' => $user->phone,
                            'address' => $user->address
                        ]
                    ];
                }
            }else{
                $response = [
                    'success' => false,
                    'message' => 'User is Disabled!'
                ];
            }

        }else{
            $response = [
                'success' => false,
                'message' => 'Credentials Mismatch!'
            ];
        }
        return $response;

    }
}
