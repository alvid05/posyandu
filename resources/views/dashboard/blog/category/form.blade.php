@extends('dashboard.template.content')
@section('active-blog', 'active')
@section('expanded-blog', 'true')
@section('show-blog', 'show')
@section('show-blog-category', 'show')
@section('title', 'Data Category')
@section('subtitle', 'Category')

@section('css')
    <link rel="stylesheet" type="text/css" href='{{ asset("filepond/css/filepond.css") }}'/>
    <link rel="stylesheet" type="text/css" href='{{ asset("filepond/css/filepond.min.css") }}'/>
    <link rel="stylesheet" type="text/css" href='{{ asset("filepond/plugin/image-preview/filepond-plugin-image-preview.min.css") }}'/>
@endsection

@section('card-content')
<!-- Light table -->
<div class="card-body">
    @isset($dataEdit)
    {{ Form::model($dataEdit, ['route' => ['update-blog-category', $dataEdit->id], 'method' => 'POST'])}}
    @else
    {{ Form::open(['route' => 'store-blog-category']) }}
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
                <label class="form-control-label">Desc</label>
                {{ Form::textarea('desc', old('desc'),
                ['class' => 'form-control', 'id' => 'desc', 'rows' => 3, 'maxlength' => '300','required'=>'required'])}}
                @error('desc')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-control-label">Image</label>
                {{ Form::file('image', ['class' => 'my-pond']) }}
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

@section('js')
    <script type="text/javascript" src='{{ asset("jquery-maxlength/bootstrap-maxlength.js") }}'></script>
    <script type="text/javascript" src='{{ asset("dashboard/assets/js/jquery.maskMoney.js") }}'></script>
    <script type="text/javascript" src='{{ asset("dashboard/assets/js/rupiah.js") }}'></script>

    <script type="text/javascript" src='{{ asset("filepond/plugin/file-encode/filepond-plugin-file-encode.min.js") }}'></script>
    <script type="text/javascript" src='{{ asset("filepond/plugin/image-resize/filepond-plugin-image-resize.js") }}'></script>
    <script type="text/javascript" src='{{ asset("filepond/plugin/image-preview/filepond-plugin-image-preview.min.js") }}'></script>
    <script type="text/javascript" src='{{ asset("filepond/plugin/file-validate-size/filepond-plugin-file-validate-size.js") }}'></script>
    <script type="text/javascript" src='{{ asset("filepond/plugin/file-validate-type/filepond-plugin-file-validate-type.js") }}'></script>
    <script type="text/javascript" src='{{ asset("filepond/js/filepond.min.js") }}'></script>

    <script>
        FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginImageResize,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview
        );

        $(function(){
        const _inputElement = document.querySelector('input[name="image"]');
        const _pond = FilePond.create( _inputElement, {
            allowMultiple: false,
            allowFileEncode: true,
            allowFileSizeValidation: true,
            allowFileTypeValidation: true,
            maxFileSize:'3MB',
            labelMaxFileSize: 'Maksimum File Sebesar 3MB',
            fileValidateTypeLabelExpectedTypes:'Expects {allButLastType} or {lastType}',
            maxFiles:1,
            required: false,
            maxParallelUploads:1,
            instantUpload:false,
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg'],
            imagePreviewMaxFileSize: '3MB',
            imagePreviewHeight: 150,
        });

        @if(isset($dataEdit))
            @if($img != null)
                _pond.addFile('{{$img}}');
            @else
            @endif
        @else
        @endif
        
        });
  </script>
@endsection
