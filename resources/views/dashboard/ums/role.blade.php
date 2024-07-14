@extends('dashboard.template.content')
@section('active-ums', 'active')
@section('expanded-ums', 'true')
@section('show-ums', 'show')
@section('show-ums-role', 'show')
@section('subtitle', 'Roles')
@section('title', 'Users Management')
@section('route-new')
    {{route('create-ums-role')}}
@endsection

@section('card-content')
<div class="card-body">
    <div class="pl-sm-4 pr-sm-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('failed'))
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
        <table class="table align-items-center table-flush small" id="table-content-7">
            <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Role</th>
                <th scope="col" class="text-center">Action</th>

            </tr>
            </thead>
            <tbody class="list">
            @foreach($role as $role)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$role->role}}</td>
                    <td class="text-center" scope="row">
                        <a href="{{route('edit-ums-role', $role->id)}}">
                            <button class="btn btn-icon btn-sm btn-2 btn-info" type="button">
                                <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                            </button>
                        </a>
                        <form method="POST" action="{{route('delete-ums-role', $role->id)}}" class="d-inline">
                            {{method_field('delete')}}
                            {{csrf_field()}}
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
        $('#table-content-7').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    </script>
@endsection
