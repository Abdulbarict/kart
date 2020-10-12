<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= DB::table('products')
        ->select('products.id','products.user_id','products.name as name','products.sku','products.price','products.discount_price','products.image','products.postion as Position','categories.name as Category')
        ->join('categories',function($join){
            $join->on("categories.user_id","=","products.user_id")
                ->on("categories.id","=","products.category_id");
        })
        ->where(['products.user_id' => Auth::id()])
        ->get();
        return view('product.products',compact('products'));
       // return response()->json(['foo'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('user_id',Auth::id())->get();
        return view('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //  Return $request->all();
         $user = Auth::user();
         $request->validate([
             'product' => 'required',
             'price' =>'required',
             'category'=>'required',
             'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
         ]);

         $product = new Product;
         $product->user_id = $user->id;
         $product->name = $request->product;
         $product->sku = $request->sku;
         $product->price = $request->price;
         $product->discount_price = $request->discount;
         $product->category_id = $request->category;
         $product->postion = $request->position;
         $product->status = $request->status;
         $product->use_type = $request->usetype;
         $product->type_name = $request->type_name;
         $product->types = $request->types;
         // $imageName = time().'.'.$request->image->extension();  
          $file = $request->file('image');
         $filename = $user->name.'-product-' . time() . '.' . $file->getClientOriginalExtension();
         $imagePath = $request->file('image')->storeAs('Products', $filename, 'public');
         $product->image = '/storage/'.$imagePath;
         $product->save();

         return redirect()->route('products.index')->with('success','Product Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::where('user_id',Auth::id())->get();
        $products= Product::where('user_id',Auth::id())->where('id',$product->id)->first();
       //return response()->json(['foo'=>$products]);
        return view('product.edit',compact('categories','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
      // Return $request->all();
        $user = Auth::user();
        $request->validate([
            'product' => 'required',
            'price' =>'required',
            'category'=>'required',
            
        ]);
         $products= Product::where('user_id',Auth::id())->where('id',$product->id)->first();
         $product->user_id = $user->id;
         $product->name = $request->product;
         $product->sku = $request->sku;
         $product->price = $request->price;
         $product->discount_price = $request->discount;
         $product->category_id = $request->category;
         $product->postion = $request->position;
         $product->status = $request->status;
         $product->use_type = $request->usetype;
         $product->type_name = $request->type_name;
         $product->types = $request->types;

         if ($request->hasFile('image')){        
            $path = public_path();
  
            //code for remove old file
            if($products->image != ''  && $products->image != null){
                 $file_old = $path.$products->image;
                 unlink($file_old);
            }
  
            $file = $request->file('image');
         $filename = $user->name.'-product-' . time() . '.' . $file->getClientOriginalExtension();
         $imagePath = $request->file('image')->storeAs('Products', $filename, 'public');
         $product->image = '/storage/'.$imagePath;
       }
        $product->save();

       return redirect()->route('products.index')->with('success','Product Updated Successfully');

        //
       // Return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
