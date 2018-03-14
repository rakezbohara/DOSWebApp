<?php

namespace App\Http\Controllers;

use App\Record;
use App\Stock;
use App\Table;
use App\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tableFree  = Table::where('mode','FREE')->get();
        $tableBusy = Table::where('mode','BUSY')->get();
        $tableWaiting = Table::where('mode','WAITING')->get();
        foreach ($tableBusy as $table){
            $table->orders = $table->order()->get();
        }
        foreach ($tableWaiting as $table){
            $table->orders = $table->order()->get();
        }
        return view('dashboard',compact('tableFree','tableBusy','tableWaiting'));
    }

    public function checkoutTable($id){
        $orders = Order::where('table_id',$id)->get();
        foreach ($orders as $order){
            /*Reducing item stock if menu item is stockable*/
            if($order->menu->stockable){
                $stock = $order->menu->stock;
                $stock->qty = $stock->qty - $order->qty;
                $stock->save();
            }
            /*Saving data to record for reporting*/
            $record = new Record();
            $record->menu_id = $order->menu_id;
            $record->qty = $order->qty;
            $record->note = $order->note;
            $record->table_id = $order->table_id;
            $record->created_at = $order->created_at;
            $record->save();
        }
        foreach ($orders as $order){
            $order->delete();
        }
        $table = Table::findOrFail($id);
        $table->mode = 'FREE';
        $table->save();
        return redirect()->route('home');
    }

    public function editOrder($id){
        $table = Table::findOrFail($id);
        $table->order = $table->order()->get();
        return view('editorder', compact('table'));
    }

    public function deleteOrder($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('home');
    }
}
