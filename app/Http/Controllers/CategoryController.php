<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Category;
use App\Helpers\ImageHelper;
use App\Traits\ApiResponser;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
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
    public function index()
    {
        //
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        try{
            $data = $request->validated();

            $category = new Category();

            if(!empty($data['image'])){
                $category->image = ImageHelper::saveImage($data);
            }

            $category->name = $data['name'];
            $category->parent_id = $data['parent_id']??Null;
            $category->save();

            return $this->successResponse(['category'=>$category,'message'=>'Category added successfully','status'=>true]);

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
        $model = Category::findOrFail($id);

        return view('category.edit',compact('model'));
        
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

            $category = Category::findOrFail($id);

            if(!empty($data['image'])){
                $category->image = ImageHelper::saveImage($data);
            }

            if(!empty($data['name'])){
                $category->name = $data['name'];
            }
            if(!empty($data['parent_id'])){
                $category->parent_id = $data['parent_id'];
            }
            $category->save();

            return $this->successResponse(['category'=>$category,'message'=>'Category updated successfully','status'=>true]);

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
            $category = Category::findOrFail($id);
        }else{
            $category = Category::whereIn("category_id",$selected_ids);
        }

        $category->delete();

        return $this->successResponse(['category'=>$category,'message'=>'Category deleted successfully','status'=>true]);
    }
}
