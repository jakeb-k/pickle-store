<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use http\Env\Response;
use App\Models\Order;
use App\Models\Product; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeController extends Controller
{   
    //Need to make a Stripe Web Hook to validate processed payment before 
    //creating new order.
     public function checkout(Request $request)
    {
        $price = $request->price;
        $name = Auth::user()->name; 
        $lineItems = []; 
        $cart = session()->get('cart');
        

        foreach($cart as $details){
            $lineItems[] = [
                'price_data'=> [
                    'currency' => 'aud',
                    'product_data'=> [
                        'name'=> $details['name']
                        //possible to add images to stripe 'images'
                    ],
                    'unit_amount'=>$details['price']*100
                ],
                'quantity' => $details['quantity']
            ];
        }

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => $lineItems, 
            'mode'        => 'payment',
            'success_url' => route('success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url'  => route('checkout',[],true),
            'customer_creation'=>'always'
        ]);

        $id = Auth::user()->id; 

        $products = [];
        $total = 0; 
        foreach($cart as $details){
            $x = $details['quantity'].','.$details['name'].','.$details['options']??""; 
            $total += $details['price']*$details['quantity']; 

            $products[] = $x; 
        }
       
        $order = new Order();
        $order->products = implode(',', $products);
        $order->status = 'unpaid'; 
        $order->total = $total;
        $order->session_id = $session->id; 
        $order->user_id = $id;
        $order->sent = false;
        $order->save(); 
 

        return redirect($session->url);
    }

    public function success(Request $request){

        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $sessionId = $request->get('session_id'); 

        try {
             $session = \Stripe\Checkout\Session::retrieve($sessionId); 
            if(!$session) {
                throw new NotFoundHttpException(); 
            }
            $customer = \Stripe\Customer::retrieve($session->customer); 
            $order = Order::where('session_id', $session->id)->where('status','unpaid')->first(); 
            
            if(!$order) {
                throw new NotFoundHttpException(); 
            }

            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            } 

            return view('products.success')->with('customer',$customer);

            } catch(\Exception $e){
                throw new NotFoundHttpException(); 

            }
         

    }
    public function webhook(){

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    // Send email to customer
                }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
