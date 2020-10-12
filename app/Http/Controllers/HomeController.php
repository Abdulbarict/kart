<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Product;
use App\User;
use App\Category;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user= Auth::id();

        $products = Product::where('user_id',$user)->count();
        //  $sub= UserSubscription::where('user_id',Auth::user()->id)->DATEDIFF(5,NOW(),'expiry_date')->get();
        // $sub->diffInDays();
        return view('home',compact('products'));
    }
    public function frontIndex(){
        $categories = Category::all();
         $products =  DB::table('products') ->select('products.id','products.name as name','products.sku','products.price', 'products.discount_price','products.image','products.use_type','products.type_name','products.types','products.postion as Position','categories.name as Category')
        ->join('categories',function($join){
            $join->on("categories.id","=","products.category_id");
        },'left outer')
        ->where(['products.status' => 1])
        ->get();
        return view('frontend.index',compact('categories','products'));
    }
}
