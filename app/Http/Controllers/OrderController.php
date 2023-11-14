<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mat;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function show($id){
        $order = Order::find($id); 
        
        $success = "";
        $users = []; 
       
        $ordered = []; 
        $total = $order->total; 
        
        $total = $order->total; 
        $user = User::find($order->user_id); 
        $users = $user; 
        $ordered = explode(",",$order->products);

        return view('products.order')->with('order', $order)->with('user', $user)->with('ordered', $ordered)->with('total', $total); 
    }
    public function store(){
        $orders = Order::all(); 
        $success = "";
        $users = []; 
        
       
        $ordered = []; 
        $total = []; 
        foreach($orders as $order){ 
            $total[] = $order->total; 
            $user = User::find($order->user_id); 
            $users[] = $user; 
        }
        $sentB = request('sentB');
        return view('products.orderT')->with('orders', $orders)->with('users', $users)->with('totals', $total)->with('sentB', $sentB); 
    
    }
    public function edit($id)
    {
        $order = Order::find($id); 
        if($order->sent == true){
            $order->sent = false; 
        } else {
            $order->sent = true; 
        }
        $order->save(); 
        $orders = Order::all(); 
        $success = "";
        $users = []; 
        $sentB = false; 

        $ordered = []; 
        $total = []; 
        foreach($orders as $order){ 
            $total[] = $order->total; 
            $user = User::find($order->user_id); 
            $users[] = $user; 
        }
        return view('products.orderT')->with('orders', $orders)->with('users', $users)->with('totals', $total)->with('sentB', $sentB);
    }
    public function index(){
        $orders = Order::all(); 
        $success = "";
        $users = []; 
        $sentB = false; 

        $ordered = []; 
        $total = []; 
        foreach($orders as $order){ 
            $total[] = $order->total; 
            $user = User::find($order->user_id); 
            $users[] = $user; 
        }
        return view('products.orderT')->with('orders', $orders)->with('users', $users)->with('totals', $total)->with('sentB', $sentB); 
    }
}
