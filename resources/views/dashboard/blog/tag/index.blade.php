@extends('dashboard.template.content')
@section('active-blog', 'active')
@section('expanded-blog', 'true')
@section('show-blog', 'show')
@section('show-blog-tag', 'show')
@section('subtitle', 'Table Tag')
@section('title', 'Tag')
@section('btn-add')
    <a href="{{route('create-blog-tag')}}" class="btn btn-sm btn-neutral"> New</a>
@endsection

@section('card-content')
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
    <table class="table align-items-center table-flush small" id="table-content">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$model->name}}</td>
                <td>
                    @if($model->type == 'Blog')
                        <span class="badge badge-primary">Blog</span>
                    @else
                        <span class="badge badge-info">Portofolio</span>
                    @endif
                </td>
                <td>
                    @if($model->status == 'Active')
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Not Active</span>
                    @endif
                </td>
                <td class="text-center" scope="row">
                    <a href="{{route('edit-blog-tag', $model->id)}}">
                        <button class="btn btn-icon btn-sm btn-2 btn-info" data-toggle="tooltip" data-placement="top" title="Edit" type="button">
                            <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                        </button>
                    </a>
                    <form method="POST" action="{{route('delete-blog-tag', $model->id)}}" class="d-inline">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                        <button class="btn btn-icon btn-sm btn-2 btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card-footer py-4">
    <nav aria-label="...">

    </nav>
</div>

@endsection
