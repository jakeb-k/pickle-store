<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Product;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile inforproduction.
     */
     public function update(Request $request, $id)
    {
        #$user = User::whereRaw('name = ?', array($request->name))->get(); 
        $user = User::find($id);
        
        $this->validate($request, [
            'name' => 'max:255',
            'email' => 'email',
            'street'=>['required', 'string', 'max:255'],
            'city'=>['required', 'string', 'max:255'],
            'state'=>['required', 'string', 'max:255'],
            'postcode'=>['required', 'digits:4'],
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email; 
        $user->street = $request->street; 
        $user->city = $request->city; 
        $user->state = $request->state; 
        $user->postcode = $request->postcode; 

        $user->save(); 
        return redirect()->back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function newFav(Request $request, $id)
    {
        $user = User::find($id);
        
        $message = "";
       
        $favs = explode(",",$user->favs); 
        if(in_array($request->product_id, $favs)){
            $index = array_search($request->product_id, $favs);
            array_splice($favs, $index, 1); 
            $user->favs = implode(",", $favs); 
            $user->save();
        } else {
            $favs[] = $request->product_id;
            $user->favs = implode(",",$favs); 
            $user->save();
        }

        return redirect()->back()->with('message', $message);
    }
    public function show($id)
    {
       
        $user = User::find($id); 
        $uProducts = explode(",",$user->favs);
        $favs = []; 
        foreach($uProducts as $d){
            $product = Product::find($d); 
            if($product != null){
                $favs[] = $product;
            }
        }
        
        return view('products.index')->with('products', collect($favs))->with('paginated', false)->with('type', 'Wishlist'); 
    }
}
