@extends('dashboard.template.content')
@section('active-ums', 'active')
@section('expanded-ums', 'true')
@section('show-ums', 'show')
@section('show-ums-users', 'show')
@section('subtitle', 'Users')
@section('title', 'Users Management')

@section('card-content')
<div class="card-body">
    <div class="pl-sm-4 pr-sm-4">
        <a href="{{ route('create-ums-users') }}">
            <button class="btn btn-primary mb-3 mt-3 float-right">Add +</button>
        </a>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Failed!</strong> {{ session('failed') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <!-- Light table -->
    <div class="table-responsive">
        <table class="table align-items-center table-flush small" id="table-content-6">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jenis Pilar</th>
                    <th scope="col">Nama Kelompok</th>
                    <th scope="col">Wilayah</th>
                    <th scope="col">Role</th>
                    <th scope="col">Active</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($users as $users)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="avatar avatar-sm rounded-circle">
                                @if ($users->avatar != null)
                                    <img alt="avatar" src="{{ asset('assets/img/users/'.$users->avatar) }}">
                                @else
                                    <img alt="avatar" src="{{ asset('dashboard/assets/img/user.png') }}">
                                @endif
                            </span>
                        </td>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                        <td>{{ $users->categoryPillar->nama_kategori ?? null }}</td>
                        <td>{{ $users->group_name }}</td>
                        <td>{{ $users->wilayah }}</td>
                        @if ($users->roles != null)
                            <td>{{ $users->roles->role }}</td>
                        @else
                            <td></td>
                        @endif

                        <td>
                            @if ($users->is_active == 'Active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Not Active</span>
                            @endif
                        </td>
                        <td class="text-center" scope="row">
                            <a href="{{ route('edit-ums-users', $users->id) }}">
                                <button class="btn btn-icon btn-sm btn-2 btn-info" type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                </button>
                            </a>
                            <form method="POST" action="{{ route('delete-ums-users', $users->id) }}" class="d-inline">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button class="btn btn-icon btn-sm btn-2 btn-warning" type="submit">
                                    <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    <div class="card-footer py-4">
        <nav aria-label="...">

        </nav>
    </div>

@endsection

@section('js')
    <script>
        $('#table-content-6').dataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7]
                    }
                }
            ],
            select: true
        });
    </script>
@endsection
