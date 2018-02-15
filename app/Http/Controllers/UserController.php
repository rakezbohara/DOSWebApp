<?php

namespace App\Http\Controllers;



use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','!=','admin')->get();
        return view('users.users',compact('users'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'unique:users,username|required|min:8|max:20',
            'email' => 'unique:users,email|required',
            'name' => 'required',
            'password' => 'required|same:confirm-password',
            'role' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = new User();
        $user->name = $input['name'];
        $user->username = $input['username'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->role = $input['role'];
        $user->address = $input['address'];
        $user->phone = $input['phone'];
        $user->save();
        redirect()->route('user.index');
    }
}
