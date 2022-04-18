@extends("layouts.app")

@section("title")
  All Categories
@endsection

@section("content")

<div class="row">
  <div class="col-md-8">
    <h1>All Categories</h1>
  </div>  
  <div class="col-md-4">
    <a type="button" class="btn btn-primary" href="{{route('category.create')}}">Add Category</a>
    <a type="button" class="btn btn-primary" href="{{route('product.index')}}">Products</a>
    <button class="btn btn-danger" onclick="deleteMany('category')">Delete</button> 
  </div>  
</div>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col"><input type="checkbox" name="check_all" id="check_all"></th>
      <th scope="col">Category Name</th>
      <th scope="col">Category Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse($categories as $category)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <th><input type="checkbox" class="check_model" value="{{$category->category_id}}"></th>
        <td>{{$category->name}}</td>
        <td>
          <div class="image_container">
            <img src="{{$category->getImage()}}">
          </div>
        </td>
        <td> 
        
          <a class="btn btn-primary" href="/category/{{$category->category_id}}">Edit</a> 
          <button class="btn btn-primary" onclick="deleteCategory({{$category->category_id}})">Delete</button> 
          @csrf
        </td>
      </tr>
    @empty
      <tr>
        <th colspan ="4" style="text-align: center;">No Category Found </th>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection