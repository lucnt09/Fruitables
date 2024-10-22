@extends('dashboard.admin.master')

@section('title')
    <h1>Thêm Mới Sản Phẩm</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm Mới Sản Phẩm</h1>

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
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" id="name"value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="price" class="form-label">Giá</label>
                        <input type="text" name="price" class="form-control" id="price" value="{{ old('price') }}">
                    </div>

                    <div class="form-group">
                        <label for="short_description" class="form-label">Mô tả ngắn</label>
                        <textarea name="short_description" class="form-control" rows="5" id="short_description">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="long_description" class="form-label">Mô tả dài</label>
                        <textarea name="long_description" class="form-control" rows="8" id="long_description">{{ old('long_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" class="form-control" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>

    </div>
@endsection
