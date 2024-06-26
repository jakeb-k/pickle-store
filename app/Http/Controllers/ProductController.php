<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Options;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metaDesc = "Discover Australia's most dynamic pickleball paddle, court and clothing retailer. Find the best, pro-level gear and elevate your game at Aussie PicklePro."; 
        return view('home')->with('message', "")->with('metaDesc', $metaDesc); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = ['Accessories','Paddles','Court','Kits','Clothing'];
      
        return view('products.create')->with('cats', $cats); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:100',
            'price'=>'required|numeric|gt:0',
            'discount'=>'nullable|numeric|gte:0',
            'delivery'=>'required|numeric|gt:5',
            'type'=>'required',
            'imageFile' => 'required',
            'imageFile.*' => 'image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048',
            'sku'=> 'nullable|max:30'
        ]);
       
        $products = Product::all(); 
        $productNames = [];
        
        $count = 1; 
       
        $newID = DB::table('products')->count() + 1; 
    
        foreach ($request->file('imageFile') as $file) {   
            $fileName = $newID.'_'.$count.'.'.$file->extension();
            $path = $file->storeAs('public/images', $fileName); 
            $images[] = $fileName; 
            $count++;
        }
            $product = new Product();
            $product->name = $request->name; 
            $product->price = $request->price;
            $product->description = $request->description ?? ""; 
            $product->sku = $request->sku; 
            $product->delivery = $request->delivery; 
            $product->url = $request->url; 
            $product->type = $request->type; 
            
            $product->image = implode(",",$images); 
            $product->tags = str_replace(" ", ",",$request->name);
            $product->rating = 0; 
            $product->discount = $request->discount ?? 0; 
            $product->available = true; 
            $product->id = $newID; 
            $product->save();

        return redirect('/admin')->with('success', 'Added Successfully!'); 
    }

    /**
     * Display the specified resource.
     */
    public function type($type)
    {
        $products = Product::where('type', 'like', '%'.$type.'%')->paginate(6); 

        //Meta description generator
        switch ($type) {
            case 'paddles':
                $metaDesc = "Shop the best, pro-level pickleball paddles in Australia at Aussie PicklePro. Elevate your game with our range of high-performance pickleball paddles!"; 
                break;
            case 'court':
                $metaDesc = "Shop the best, pro-level pickleball courts in Australia at Aussie PicklePro. Practice anytime and anywhere with our pickleball courts!"; 
                break;
            case 'accessories':
                $metaDesc = "Shop the best, pro-level pickleball gear in Australia at Aussie PicklePro. Elevate your game with our range of high-performance pickleball gear!"; 
                break;
            case 'clothing':
                $metaDesc = "Shop the best pickleball clothing in Australia at Aussie PicklePro. Express yourself on the court with our large range of hats, t-shirts and hoodies!"; 
                break;
            case 'kits':
                $metaDesc = "Shop the best value pickleball kits in Australia at Aussie PicklePro. Our kits are perfect for starters or those looking to elevate their game!"; 
                break;
            default:
                $metaDesc = "Shop the best, pro-level pickleball gear in Australia at Aussie PicklePro. Elevate your game with our range of high-performance pickleball gear!"; 
                break;
        }
        return view('products.index')->with('products',$products)->with('type',$type)->with('metaDesc', $metaDesc);
    }
    //bring up detail view for specific product
    public function show(string $id) {

        $product = Product::find($id);
        if($product == null) {
            abort(404);
        }
        $rReviews = Review::whereRaw('product_id = ?', array($id))->get(); 
        $reviews = []; 
 
        //potentially add image, probs not tho
        
        if($rReviews->isNotEmpty()) {
            $tot = 0; 
            foreach($rReviews as $r) {
                $u = User::find($r['user_id']);
                $tot += $r['rating']; 
                $n = [$u['name'],$r['rating'],$r['content'],$r['created_at']];
                $reviews[]=$n; 
            }
            $product->rating = $tot/count($rReviews); 
            $product->save(); 
        } else {
            $product->rating = 0; 
            $product->save(); 
        }
        
        
        $type = $product->type; 
        $options = []; 
        
        if($type == "Clothing") {
            $s = Options::find(21); 
            $sizes = explode(".",$s->values); 

            $cOptions = Options::whereRaw('product_id = ?', array($id))->get();
            
            $x = isset($cOptions[0]->values) && $cOptions[0]->type != 'size';
            
            if($x){
                $colors = explode(".",$cOptions[0]->values); 
            } else {
                $colors = []; 
            }
            $clothing = true; 
            return view('products.show')->with('product', $product)->with('reviews',$reviews)->with('colors',$colors)->with('sizes',$sizes)->with('clothing',true); 

        } else {
            $ops = $product->options()->get(); 
            $options = []; 
            $colors = []; 
            foreach($ops as $o) {
                if($o->type == 'color' || $o->type == 'Color' ) {
                    $colors = explode(".",$o->values); 
                }
                else {
                    $options[] = $o; 
                }
            } 
            //dd($options); 
            $clothing = false; 
            $metaDesc = $product->description; 
            return view('products.show')->with('product', $product)->with('reviews',$reviews)->with('options',$options)->with('clothing',false)->with('colors',$colors)->with('metaDesc', $metaDesc); 

        }
        
       


    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id); 
        
        $cats = ['Accessories','Paddles','Court','Kits','Clothing'];

        $tags = explode(",", $product->tags); 

        $ops = $product->options()->get();  

        return view('products.edit')->with('product', $product)->with('cats', $cats)->with('tags', $tags)->with('options',$ops); 


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $this->validate($request,[
            'name'=>'required|max:255',
            'price'=>'required|numeric|gt:0',
            'discount'=>'nullable|numeric',
            'delivery'=>'required|numeric|gt:0',
            'type'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048'
        ]);
        $product = Product::find($id); 
        $count = 1; 
        if($request->file('imageFile')) {
            foreach ($request->file('imageFile') as $file) {   
                $fileName = $id.'_'.$count.'.'.$file->extension();
                $path = $file->storeAs('public/images', $fileName); 
                $images[] = $fileName; 
                $count++; 
            }
            $img =  implode(",", $images);
        } else {
            $img = $product->image; 
        }
       
        
        if($request->image != null) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
        } else {
            $fileName = $product->image; 
        }

        if($request->type == 'Accessories'){
            $type = $product->type; 
        } else {
            $type = $request->type;
        }
        $product->name = $request->name; 
        $product->price = $request->price;
        $product->description = $request->description ?? ""; 
        $product->type = $type; 
        $product->image = $img; 
        $product->delivery = $request->delivery; 
        $product->discount = $request->discount ?? 0; 
        $product->save();
        return redirect('/admin')->with('success', 'Added Successfully!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id); 

        $product->delete(); 

        return redirect()->back(); 
    }

    
    //update product availability 
    
    public function available($id){
        $product = Product::find($id); 
      
        $product->available = !$product->available; 

        $product->save(); 
        
        $products = Product::all(); 

        return redirect()->back();
    }

    //add and delete tags on edit form
    public function addTag(Request $request, $id) {
        $product = Product::find($id);
        $tags = explode(",",$product->tags); 
        $tags[] = $request->tag; 
        
        $product->tags = implode(",",$tags);
        $product->save(); 
        return redirect()->back(); 
    }
    public function deleteTag($id, $tag){
        
        $product = Product::find($id);
        $tags = explode(",",$product->tags); 
    
        $index = array_search($tag, $tags);
        array_splice($tags, $index, 1); 
        $product->tags = implode(",", $tags); 
        $product->save();
        
        return redirect()->back(); 
    }

    //cart functions
    public function addToCart($id, Request $request)
    { 

        $product = Product::find($id);
        
        
        if(!$product) {
            abort(404);
        }
        $a = explode(",",$product->image); 
        $image = $a[0]; 
        $cart = session()->get('cart');
       
        if($product->type == 'Clothing') {
            $color = $request->color ?? ""; 
            $size = $request->size ?? "";
            $options = [$color,$size]; 
        } else {
            $color = $request->color ?? "";
            
            $option = $request->option ?? ""; 
            $options = [$option, $color];
        }
        
        //dd($cart); 
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "id"=> $product->id, 
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price - ($product->price * $product->discount ?? 0),
                        "image"=>$image,
                        "options"=>implode(",",$options ?? [])
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        //if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            if($cart[$id]['options'] == implode(",",$options)) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
            } 
            $cart[$id+1] = [
            "id"=> $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price - ($product->price * $product->discount ?? 0),
            "image" => $image,
            "options"=>implode(",",$options ?? []) 
            ];
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }
            // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id"=> $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price - ($product->price * $product->discount ?? 0),
            "image" => $image,
            "options"=>implode(",",$options ?? []) 
        ];
        session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request)
    { 
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function clearCart(){
        session()->forget('cart');
        return redirect()->back()->with('products', Product::paginate(6));
    }

     //add and delete tags on edit form
    public function addOption(Request $request, $id) {

       
        $option = Options::find($id); 
        
        $values = explode(".",$option->values); 

        $values[] = $request->option; 
        
        $option->values = implode(".",$values);
        $option->save(); 
        return redirect()->back(); 
    }
    public function deleteOption($id, $tag){
        
        $option = Options::find($id);
        $values = explode(".",$option->values); 
    
        $index = array_search($tag, $values);
        array_splice($values, $index, 1); 
        $option->values = implode(".", $values); 
        $option->save();
        
        return redirect()->back(); 
    }

    public function filter(Request $request, $type){
        $fil = $request->filter; 
        
       //add rating field to products to sort by popularity
        switch($fil) {
            case 'ex':
                $products =  Product::where('type', 'like', '%' . $type . '%')->orderBy('price')->get(); 
                $filterTag = 'Filtered by Price ↓'; 
                break;
            case 'ch':
                $products = Product::where('type', 'like', '%' . $type . '%')->orderByDesc('price')->get();
                $filterTag = 'Filtered by Price ↑'; 
                break;
            case 'pop':
                $products =  Product::where('type', 'like', '%' . $type . '%')->orderByDesc('rating')->get(); 
                $filterTag = 'Filtered by Popularity ↓';
                break;
        }
        
        return view('products.index')->with('products', $products)->with('filterTag', $filterTag)->with('paginated', false)->with('type', $type); 
    }

    //Show the admin dashboard
    public function admin(){
        $cats = ['Accessories','Paddle','Court','Kit','Clothing'];

        $products = Product::all();

        return view('products.admin')->with('products',$products)->with('cats', $cats);
    }

    //sort admin results for quicker access
    public function adminSort(Request $request){
        $fil = $request->filter; 
        $cats = ['Accessories','Paddle','Court','Kit','Clothing'];
            
        $products =  Product::where('type', 'like', '%' . $fil . '%')->get(); 

        
        return view('products.admin')->with('products', $products)->with('cats', $cats); 
    }

    public function search() {
        $validatedData = request()->validate([
            'query' => 'required|max:50',
        ]);
        $search = $validatedData['query']; 
        
        $search = preg_replace('/-/', " ", $search);
   
        $a = explode(" ", $search); 
        $b = $a[0];
       
        $products = Product::where('tags', 'like', '%' . $b . '%')->get(); 

        $metaDesc = "Shop the best, pro-level pickleball gear in Australia at Aussie PicklePro. Elevate your game with our range of high-performance pickleball gear!"; 

        if($products->isEmpty()) {
            return redirect()->back()->with('no_search', 'There are no matching products');
        } else {
            return view('products.index')->with('products', $products)->with('type', $search)->with('paginated', false)->with('metaDesc', $metaDesc); 
        }
        
        
    }

}
