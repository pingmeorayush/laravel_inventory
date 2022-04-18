@extends("layouts.app")

@section("title")
  Add Category
@endsection

@section("content")

<div class="row">
  <div class="col-md-10">
    <h1>Add Category</h1>
  </div>  
  <div class="col-md-2">
    <a type="button" class="btn btn-primary" href="{{route('category.index')}}">Categories</a>
  </div>  
</div>

<form id="category" action="{{route('category.store')}}" method="POST"> 
  @csrf
  <div class="form-group">
    <label for="category_name">Category Name</label>
    <input type="text" name="name" @if(!empty($model)) value="{{$model->name}}" @endif class="form-control" id="category_name" aria-describedby="categoryHelp" placeholder="Enter Category Name">
    <small id="categoryHelp" class="form-text text-muted">Enter the name of your category.</small>
  </div>
  <div class="form-group">
    <label for="category_image">Image</label>
    <input type="file" name="image" class="form-control" onchange="readURL(this);" id="category_image" placeholder="Password">
    <img style="display: none;" id="image_review" src="#" alt="your image" />
  </div>

  <div class="form-group">
    <label for="category_parent">Parent Category</label>
    <select class="custom-select" name="parent_id" id="category_parent">
      @foreach($categories as $category)
        <option value="{{$category->category_id}}">{{$category->name}}</option>
      @endforeach
    </select>
    <img style="display: none;" id="image_review" src="#" alt="your image" />
  </div>

  <button type="submit" class="btn btnji btn-primary">Submit</button>
</form>
@endsection
