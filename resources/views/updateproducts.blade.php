@extends('admin')

@section('content')
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
        
        <button type="submit">Update Product</button>
    </form>
@endsection
