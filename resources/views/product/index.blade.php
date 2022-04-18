@extends("layouts.app")

@section("title")
  All Products
@endsection

@section("content")

<div>
  <h1>All Products</h1>
</div>  
<div class="row">
  <div class="col-md-8">
    <nav class="navbar navbar-light bg-light">
      <form class="form-inline" method="GET" action="{{route('product.index')}}">
        <input class="form-control mr-sm-2" type="search" name="text" placeholder="Search" aria-label="Search">
        <select class="form-control mr-sm-2 custom-select" id="inputGroupSelect01" name="category_id">
          <option value="" selected>Choose...</option>
          @foreach($categories as $category)
            <option value="{{$category->category_id}}">{{$category->name}}</option>
          @endforeach
        </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </nav>
  </div>
  <div class="col-md-4">
    <a type="button" class="btn btn-primary" href="{{route('category.index')}}">Categories</a>
    <a type="button" class="btn btn-primary" href="{{route('product.create')}}">Add Product</a>
    <button class="btn btn-danger" onclick="deleteMany('product')">Delete</button>
  </div>  
</div>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col"><input type="checkbox" name="check_all" id="check_all"></th>
      <th scope="col">Product Name</th>
      <th scope="col">Product Description</th>
      <th scope="col">Product Image</th>
      <th scope="col">Category</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse($products as $product)
      <tr>
        <th scope="row">
          {{$loop->iteration}}
        </th>
        <th>
          <input type="checkbox" class="check_model" value="{{$product->product_id}}">
        </th>
        <td>
          {{$product->name}}
        </td>
        <td>
          {{$product->description}}  
        </td>
        <td>
          <div class="image_container">
            <img src="{{$product->getImage()}}">
          </div>
        </td>
        <td>
          @if($product->category)
            {{$product->category->name}}
          @endif
        </td>
        <td> 
          <a class="btn btn-primary" href="/product/{{$product->product_id}}">Edit</a> 
          <button class="btn btn-primary" onclick="deleteProduct({{$product->product_id}})">Delete</button> 
          @csrf
        </td>
      </tr>
    @empty
      <tr>
        <th colspan ="4" style="text-align: center;">No Product Found </th>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection