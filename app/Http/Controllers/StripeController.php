<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product; 

class StripeController extends Controller
{   
    //Need to make a Stripe Web Hook to validate processed payment before 
    //creating new order.
     public function checkout(Request $request)
    {
        $price = $request->price;
        $name = Auth::user()->name; 
        

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'AUD',
                        'product_data' => [
                            'name' => 'Order for: '.$name,
                        ],
                        'unit_amount'  => $price*100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(){
        $cart = session()->get('cart');
        $id = Auth::user()->id; 

        $products = [];
        $total = 0; 
        foreach($cart as $details){
            $x = $details['quantity'].','.$details['name']; 
            $total += $details['price']*$details['quantity']; 

            $products[] = $x; 
        }
       

        $order = new Order();
        $order->products = implode(',', $products);
        $order->total = $total;
        $order->user_id = $id;
        $order->sent = false;
        $order->save(); 

        session()->forget('cart');
        
        return view('home')->with('products', Product::paginate(6));

    }
}
