<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addReview(Request $request, $id){
        
        
        $this->validate($request,[
            'content'=>'required|max:255',
            'rating'=>'required|numeric',
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048'
        ]);


        $review = new Review(); 
       
                
        $review->content = $request->content; 
        $review->rating = $request->rating; 
        $review->product_id = $id; 
        $review->user_id = Auth::user()->id; 
        $review->save();
        return back(); 
        
    }
}
