<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{

    // public function __construct()
    // {
    //   $user = Auth::user(); 
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return view('category.category');
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

         $request->validate([
            'category' => 'required|string'
        ]);

        $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->name = $request->category;
        $category->save();

        return response()->json([ 'success'=> 'Category is successfully submitted!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        // $category->user_id = Auth::user()->id;
        $category->name = $request->category;
        $category->save();
        return response()->json([ 'success'=> 'Category is successfully Updated!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([ 'success'=> 'Category Deleted Successfully!']);
    }

    public function ApiList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        // $columnIndex_arr = $request->get('order');
        // $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

 
        $searchValue = $search_arr['value']; // Search value

        $totalRecords = Category::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Category::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        $data = Category::orderBy('created_at','desc')
                    ->where('name', 'like', '%' .$searchValue . '%')
                    ->where('user_id', Auth::id())
                    ->get();
       return ["draw" => intval($draw), 
                "iTotalRecords" =>  $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "data"=>$data
                    ];
    }   
}
