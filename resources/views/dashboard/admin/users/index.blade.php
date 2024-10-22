@extends('dashboard.admin.master')

@section('title')
    <h1>Danh Sách Users</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Sách Users</h1>

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
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($userData as $user)
                            <tbody>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->type === 'admin')
                                        <span style="color: red;">Admin</span>
                                    @else
                                        <span style="color: rgb(44, 228, 44);">User</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->is_active)
                                        <span style="color: green;">Kích hoạt</span>
                                    @else
                                        <span style="color: red;">Vô hiệu hóa</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->type !== 'admin')
                                        <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                                                {{ $user->is_active ? 'Vô hiệu hóa' : 'Kích hoạt' }}
                                            </button>
                                        </form>
                                    @else
                                        <span style="color: gray;">Admin (không thể tắt)</span>
                                    @endif
                                </td>
                            </tbody>
                        @endforeach

                        {{ $userData->links() }}
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
