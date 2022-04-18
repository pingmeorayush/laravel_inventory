<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\{Product,Category};
use App\Helpers\ImageHelper;
use App\Traits\ApiResponser;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    use ApiResponser;

    function __construct()
    {
       View::share('categories',Category::orderBy("category_id","desc")->get());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $text = $request->input("text",null);

        $category_id = $request->input("category_id",null);

        $products = new Product();

        if(!empty($text)){
            $products = $products->where("name","like","%$text%");
        }

        if(!empty($category_id)){
            $products = $products->where("category_id",$category_id);
        }

        $products = $products->orderBy("product_id","desc")->get();

        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try{
            $data = $request->validated();
            
            $product = new Product();

            if(!empty($data['image'])){ 
                $product->image = ImageHelper::saveImage($data);
            }

            $product->name = $data['name'];
            $product->category_id = $data['category_id'];
            $product->description = $data['description'];
            $product->save();

            return $this->successResponse(['product'=>$product,'message'=>'Product added successfully','status'=>true]);

        }catch(Exception $e){

            return $this->errorResponse("Somthing Went Wrong.",500);
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
        $model = Product::findOrFail($id);

        return view('product.edit',compact('model'));
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
        try{

            $data = $request->all();

            $product = Product::findOrFail($id);

            if(!empty($data['image'])){
                $product->image = ImageHelper::saveImage($data);
            }

            if(!empty($data['name'])){
                $product->name = $data['name'];
            }
            if(!empty($data['description'])){
                $product->description = $data['description'];
            }
            if(!empty($data['category_id'])){
                $product->category_id = $data['category_id'];
            }
            $product->save();

            return $this->successResponse(['product'=>$product,'message'=>'Product updated successfully','status'=>true]);

        }catch(Exception $e){

            return $this->errorResponse("Somthing Went Wrong.",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id=null)
    {
        $selected_ids = $request->input("id",null);

        if(!empty($id)){
            $product = Product::findOrFail($id);
        }else{
            $product = Product::whereIn("product_id",$selected_ids);

        }
        
        $product->delete();

        return $this->successResponse(['product'=>$product,'message'=>'Product deleted successfully','status'=>true]);
    }
}
