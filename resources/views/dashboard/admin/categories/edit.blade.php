@extends('dashboard.admin.master')

@section('title')
    <h1>Cập Nhật Danh Mục</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cập Nhật Danh Mục</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ $category->name }}" name="name" id="name" required>
                    </div>
                    <div>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                style="width: 200px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-info" href="{{ route('categories.index') }}">Danh Sách</a>

                </form>
            </div>
        </div>

    </div>
@endsection
