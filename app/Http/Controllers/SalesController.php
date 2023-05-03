<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::pluck('title', 'id');
        return view('sales.index', compact('categories'));
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
        foreach ($request->category as $index => $category) {
            Sale::create([
                'category_id' => $category,
                'product_id' => $request->product[$index],
                'unit' => $request->unit[$index],
                'price' => $request->price[$index],
            ]);
        }

        return back();
    }

    public function ShowProduct($id){
        $getproduct = Product::where('category_id', $id)->get();
        if($getproduct){
            return response()->json([
                'data'=> $getproduct,
                'status'=>'ok',
            ]);
        }
        else{
            return response()->json([
                'status'=>'error'
            ]);
        }
    }

    public function productDetail($id){
        $product = Product::where('id', $id)->firstOrFail();
        if($product){
            return response()->json([
                'data'=> $product,
                'status'=>'ok',
            ]);
        }
        else{
            return response()->json([
                'status'=>'error'
            ]);
        }
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
        //
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

}
