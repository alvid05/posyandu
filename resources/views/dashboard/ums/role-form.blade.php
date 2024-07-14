@extends('dashboard.template.content')
@section('active-ums', 'active')
@section('expanded-ums', 'true')
@section('show-ums', 'show')
@section('show-ums-role', 'show')
@section('subtitle', 'Roles')
@section('title', 'Users Management')

@section('css')
    <link rel="stylesheet" type="text/css" href='{{ asset("filepond/css/filepond.css") }}'/>
    <link rel="stylesheet" type="text/css" href='{{ asset("filepond/css/filepond.min.css") }}'/>
    <link rel="stylesheet" type="text/css" href='{{ asset("filepond/plugin/image-preview/filepond-plugin-image-preview.min.css") }}'/>
@endsection

@section('card-content')
<!-- Light table -->
<div class="card-body">
    @if(isset($role))
        {{ Form::model($role, ['route' => ['update-ums-role', $role->id], 'method' => 'POST'])}}
    @else
        {{ Form::open(['route' => 'store-ums-role']) }}
    @endif

    {{csrf_field()}}
        <div class="pl-lg-4">

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-air-baloon"></i></span>
                <span class="alert-text"><strong>Gagal!</strong> Data gagal diinputkan, silahkan cek form kembali!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            <div class="form-group">
                <label class="form-control-label">Role</label>
                {{ Form::text('role', old('role'), 
                ['class' => 'form-control', 'id' => 'role', 'maxlength' => '50'])}}
                @error('role')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>
            

            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-default" onclick="history.go(-1);">Cancel</button>
                </div>
          </div>

        </div>
        
    {{ Form::close() }}

</div>
<div class="card-footer py-4">
    <nav aria-label="...">
    
          
    </nav>
</div>

@endsection

@section('js')
    <script type="text/javascript" src='{{ asset("jquery-maxlength/bootstrap-maxlength.js") }}'></script>
    <script>
      $(document).ready(function(){
            $('#role').maxlength()
      });
    </script>
@endsection