@extends('dashboard.template.content')
@section('active-blog', 'active')
@section('expanded-blog', 'true')
@section('show-blog', 'show')
@section('show-blog-tag', 'show')
@section('title', 'Data tag')
@section('subtitle', 'tag')

@section('card-content')
<!-- Light table -->
<div class="card-body">
    @isset($dataEdit)
    {{ Form::model($dataEdit, ['route' => ['update-blog-tag', $dataEdit->id], 'method' => 'POST'])}}
    @else
    {{ Form::open(['route' => 'store-blog-tag']) }}
    @endisset
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
                <label class="form-control-label">Name</label>
                {{ Form::text('name', old('name'),
                ['class' => 'form-control', 'id' => 'name', 'maxlength' => '150','required'=>'required'])}}
                @error('name')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control-label">Type</label>
                {{ Form::select('type', 
                        ['' => 'Selected Answer', 'Blog' => 'Blog', 'Portofolio' => 'Portofolio'], 
                        old('type'), 
                        ['class' => 'form-control'])}}
                @error('type')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control-label">Status</label>
                {{ Form::select('status', 
                        ['' => 'Selected Answer', 'Active' => 'Yes', 'Inactive' => 'No'], 
                        old('status'), 
                        ['class' => 'form-control'])}}
                @error('status')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">

                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button mt-2" class="btn btn-outline-default" onclick="history.go(-1);">Cancel</button>
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
