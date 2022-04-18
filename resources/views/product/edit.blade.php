@extends("layouts.app")

@section("title")
  Edit Product
@endsection

@section("content")

<div class="row">
  <div class="col-md-10">
    <h1>Edit Product</h1>
  </div>  
  <div class="col-md-2">
    <a type="button" class="btn btn-primary" href="{{route('product.index')}}">Products</a>
  </div>  
</div>

<form id="product" action="/product/{{$model->product_id}}" method="POST"> 
  @method('PATCH')
  @csrf
  <div class="form-group">
    <label for="product_name">Product Name</label>
    <input type="text" name="name" @if(!empty($model)) value="{{$model->name}}" @endif class="form-control" id="product_name" aria-describedby="categoryHelp" placeholder="Enter Product Name">
    <small id="categoryHelp" class="form-text text-muted">Enter the name of your product.</small>
  </div>
  <div class="form-group">
    <label for="product_image">Image</label>
    <input type="file" name="image" class="form-control" onchange="readURL(this);" id="product_image" placeholder="Password">
    <img id="image_review" @if(!empty($model->image)) src="{{$model->getImage()}}" @endif alt="your image" />
  </div>

  <div class="form-group">
    <label for="category_id">Category</label>
    <select class="custom-select" name="category_id" id="category_id">
      @foreach($categories as $category)
        <option value="{{$category->category_id}}" @if($model->category_id == $category->category_id) selected @endif>{{$category->name}}</option>
      @endforeach
    </select>
    <img style="display: none;" id="image_review" src="#" alt="your image" />
  </div>

  <div class="form-group">
    <label for="product_description">Product Description</label>
    <input type="text" name="description" @if(!empty($model)) value="{{$model->description}}" @endif class="form-control" id="product_description" aria-describedby="descHelp" placeholder="Enter Description">
    <small id="descHelp" class="form-text text-muted">Enter the description of your product.</small>
  </div>

  <button type="submit" class="btn btnji btn-primary">Submit</button>
</form>
@endsection
