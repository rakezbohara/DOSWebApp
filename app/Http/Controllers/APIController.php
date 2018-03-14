<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Order;
use App\Table;
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

    public function getTables(){
        $tables = Table::where('status', true)->get();
        if(!$tables){
            $response = [
                'success' => false,
                'message' => 'No Table found!',
                'tables' => [
                ]
            ];
        }else{
            $response = [
                'success' => true,
                'message' => 'Table Successfully Loaded!',
                'tables' => $tables
            ];
        }
        return $response;
    }

    public function getMenus(){
        $menus = Menu::where('status', true)->with('category')->get();
        if(!$menus){
            $response = [
                'success' => false,
                'message' => 'No Menu found!',
                'menus' => [
                ]
            ];
        }else{
            $response = [
                'success' => true,
                'message' => 'Menu Successfully Loaded!',
                'menus' => $menus
            ];
        }
        return $response;
    }

    public function getCategories(){
        $categories = Category::where('status', true)->get();
        if(!$categories){
            $response = [
                'success' => false,
                'message' => 'No Menu found!',
                'categories' => [
                ]
            ];
        }else{
            $response = [
                'success' => true,
                'message' => 'Menu Successfully Loaded!',
                'categories' =>$categories
            ];
        }
        return $response;
    }

    public function postOrder(Request $request){
        $input = $request::all();
        $table = Table::find($input['table_no']);
        $table->mode = 'BUSY';
        $table->save();
        foreach ($input['orders'] as $orderItem){
            $order = new Order();
            $order->menu_id = $orderItem['item_id'];
            $order->table_id = $input['table_no'];
            $order->qty = $orderItem['qty'];
            $order->note = $orderItem['note'];
            $order->save();
        }
        $response = [
            'success' => true,
            'message' => 'Order placed successfully.'
        ];
        return $response;
    }

    public function postCheckout(Request $request){
        $input = $request::all();
        $table = Table::find($input['table_no']);
        $table->mode = 'WAITING';
        $table->save();
        $response = [
            'success' => true,
            'message' => 'Checkout successful.'
        ];
        return $response;
    }

}
