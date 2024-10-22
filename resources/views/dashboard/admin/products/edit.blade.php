@extends('dashboard.admin.master')

@section('title')
    <h1>Cập Nhật Sản Phẩm</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cập Nhật Sản Phẩm</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control"
                            id="name"value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                    </div>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100"
                            class="mt-2">
                    @endif

                    <div class="form-group">
                        <label for="price" class="form-label">Giá</label>
                        <input type="text" name="price" class="form-control" id="price"
                            value="{{ $product->price }}">
                    </div>

                    <div class="form-group">
                        <label for="short_description" class="form-label">Mô tả ngắn</label>
                        <textarea name="short_description" class="form-control" id="short_description" rows="5">{{ $product->short_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="long_description" class="form-label">Mô tả dài</label>
                        <textarea name="long_description" class="form-control" id="long_description" rows="8">{{ $product->long_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" class="form-control" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>   
            </div>
        </div>

    </div>
@endsection
