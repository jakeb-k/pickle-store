<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
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
      
        foreach($cart as $details){
            $x = $details['quantity'].','.$details['name']; 
            $total += $details['total']; 

            $products[] = $x; 
        }
        $taxedTotal = $total + ($total*0.1); 

        $order = new Order();
        $order->products = implode(',', $products);
        $order->total = $taxedTotal;
        $order->user_id = $id;
        $order->sent = false;
        $order->save(); 

        session()->forget('cart');
        
        return view('home')->with('products', Product::paginate(6));

    }
}
