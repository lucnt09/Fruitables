@extends('dashboard.admin.master')

@section('title')
    <h1>
        Danh Sách Danh Mục</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Sách Danh Mục</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($categories as $category)
                            <tbody>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->image)
                                        <img class="card-img-sm" src="{{ \Storage::url($category->image) }}" width="150px"
                                            alt="">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Update</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are u want to delete ?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tbody>
                        @endforeach

                        {{ $categories->links() }}

                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
