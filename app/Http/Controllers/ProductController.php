<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = ['Accessories','Paddle','Court','Kits','Clothing'];
      
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
            'type'=>'required',
            'imageFile' => 'required',
            'imageFile.*' => 'image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
            'sku'=> 'required|max:30'
        ]);
       
        $products = Product::all(); 
        $productNames = [];
        
        $count = 0; 
        foreach ($request->file('imageFile') as $file) {   
            $count++; 
            $fileName = time() .$count. '.' . $file->extension();
            $path = $file->storeAs('public/images', $fileName); 
            $images[] = $fileName; 
        }
           
            $product = new Product();
            $product->name = $request->name; 
            $product->price = $request->price;
            $product->description = $request->description ?? ""; 
            $product->sku = $request->sku; 
            $product->url = $request->url; 
            $product->type = $request->type; 
            $product->image = implode(",",$images); 
            $product->tags = str_replace(" ", ",",$request->name);
            $product->rating = 0; 
            $product->available = true; 
           
            $product->save();

        return redirect('/admin')->with('success', 'Added Successfully!'); 
    }

    /**
     * Display the specified resource.
     */
    public function type($type)
    {
        $products = Product::where('type', 'like', '%'.$type.'%')->paginate(6); 
       
        return view('products.index')->with('products',$products)->with('type',$type);
    }
    //bring up detail view for specific product
    public function show(string $id) {

        $product = Product::find($id);
        return view('products.show')->with('product', $product); 

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id); 
        
        $cats = ['Accessories','Paddle','Court','Kits','Clothing'];

        $tags = explode(",", $product->tags); 

        return view('products.edit')->with('product', $product)->with('cats', $cats)->with('tags', $tags); 


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $this->validate($request,[
            'name'=>'required|max:255',
            'price'=>'required|numeric|gt:0',
            'type'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048'
        ]);
        $product = Product::find($id); 
        $count = 0; 
        if($request->file('imageFile')) {
            foreach ($request->file('imageFile') as $file) {   
                $count++; 
                $fileName = time() .$count. '.' . $file->extension();
                $path = $file->storeAs('public/images', $fileName); 
                $images[] = $fileName; 
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
        if($request->type == 'Golf'){
            $type = $product->type; 
        } else {
            $type = $request->type;
        }
        $product->name = $request->name; 
        $product->price = $request->price;
        $product->description = $request->description ?? ""; 
        $product->type = $type; 
        $product->image = $img; 
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

    //Show the admin dashboard
    public function admin(){
        $cats = ['Accessories','Paddle','Court','Kit','Clothing'];

        $products = Product::all();

        return view('products.admin')->with('products',$products)->with('cats', $cats);
    }
    //update product availability 
    
    public function available($id){
        $product = Product::find($id); 
      
        $product->available = !$product->available; 

        $product->save(); 

        $cats = ['Golf','Yoga','Gymnastics','Lifting','Vehicle','Bathroom','Office','Pets','Fatigue','Placeproducts','Rugs','Kids','Welcome','Outdoor','Tapestry'];
        
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
    public function addToCart($id)
    {
        $product = Product::find($id);
        
        
        if(!$product) {
            abort(404);
        }
        $a = explode(",",$product->image); 
        $image = $a[0]; 
        $cart = session()->get('cart');
        
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "id"=> $product->id, 
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image"=>$image
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
      
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id"=> $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $image 
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
}
