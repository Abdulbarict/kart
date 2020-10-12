<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Shop; 
use App\Product; 
use App\DeliveryType; 
use App\Settings; 
use App\Category; 
use App\Countries; 
use DB;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = Use::all();

        if(Auth::user()->is_superadmin)
            return view('users.users',compact('users'));
        else
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);
      return view('profile.profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateAppStatus(Request $request)
    {
        $user= User::where('id',$request->id)->first();
        $user->active_app=1;
        $user->save();
        return response()->json([ 'success'=> "Activated Successfully.."]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function frontEnd($slug)
    {
        $user = User::where('username',$slug)->firstOrFail();
        if(!$user){
            return view(404);
        }
        $shop = Shop::where('user_id',$user->id)->firstOrFail();
        if(!$shop){
            return view(404);
        }
        $categories = Category::where('user_id',$user->id)->get();
        $country = Countries::where('id',$shop->country)->firstOrFail();
        $products =  DB::table('products') ->select('products.id','products.user_id','products.name as name','products.sku','products.price', 'products.discount_price','products.image','products.use_type','products.type_name','products.types','products.postion as Position','categories.name as Category')
        ->join('categories',function($join){
            $join->on("categories.user_id","=","products.user_id")
                ->on("categories.id","=","products.category_id");
        },'left outer')
        ->where(['products.user_id' => $user->id])->where(['products.status' => 1])
        ->get();
       
        $delivery_types = DeliveryType::where('user_id',$user->id)->where('status',1)->get();

        $delivery_charge = DeliveryType::where('user_id',$user->id)->where('is_delivery_charge',1)->get();
        // $results = array_merge($settings,$delivery_charge);
        $delivery = array();
        foreach ($delivery_charge as $key=>$value) {
             $delivery []= $value->type_name;
        }

        $option_arr = array(  'active'=> $shop->settingsByKey('is_delivery_charge',$shop->id)?true:false,
                    'amount'=>$shop->settingsByKey('delivery_charge_amount',$shop->id),
                    'text'=>$shop->settingsByKey('delivery_charge_text',$shop->id),
                    'extra_charge_upto'=>$shop->settingsByKey('extra_charge_upto',$shop->id),
                    'option'=>$delivery,
                );
          $options = json_encode($option_arr);
      //    return response()->json(['foo'=>$options]);
         $timezone=$user->timezone;
        if($slug == $user->username){
            return view('frontend.index',compact('shop','products','delivery_types','options','categories','country','timezone'));
        }
       
    }
}
