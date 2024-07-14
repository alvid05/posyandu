@extends('dashboard.template.app')
@section('title', 'Profile')
@section('active-profile', 'active')
@section('css')
    <link rel="stylesheet" type="text/css" href='{{ asset('filepond/css/filepond.css') }}' />
    <link rel="stylesheet" type="text/css" href='{{ asset('filepond/css/filepond.min.css') }}' />
    <link rel="stylesheet" type="text/css"
        href='{{ asset('filepond/plugin/image-preview/filepond-plugin-image-preview.min.css') }}' />
    <link href="{{ asset('sun-editor/css/suneditor.min.css') }}" rel="stylesheet" type="text/css">
    <!-- codeMirror -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.css">
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css">
@endsection
@section('content')
    <div class="header bg-danger pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Profile</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- Card stats -->

            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">

        <div class="row">
            <div class="col">
                <div class="card border-0 pb-6 pt-6">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-6 text-center">
                            @php
                                $user = App\Models\Users::find(Auth::user()->id);
                            @endphp
                            @if ($user->avatar != null)
                                <img alt="avatar" src="{{ asset('assets/img/users/'.$user->avatar) }}" width="200px" height="200px" style="border-radius: 50%">
                            @else
                                <img alt="avatar" src="{{ asset('dashboard/assets/img/user.png') }}" width="200px" height="200px">
                            @endif
                        </div>
                        <div class="col-lg-6 mr-2">
                            {{ Form::model($user, ['route' => ['view-profile'], 'method' => 'POST']) }}
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

                            <div class="form-group">
                                <label class="form-control-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                @error('username')
                                    <p class="text-warning small">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">E-mail</label>
                                {{ Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'maxlength' => '20','readonly' => true]) }}
                                @error('email')
                                    <p class="text-warning small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Jenis Pilar</label>
                                <input type="text" class="form-control" value="{{ $user->CategoryPillar->nama_kategori }}" readonly>
                                @error('jenis_pilar')
                                    <p class="text-warning small">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nama Kelompok</label>
{{--                                        {{ Form::text('nama_kelompok', old({{ auth()->user()->name }}), ['class' => 'form-control', 'id' => 'nama_kelompok', 'maxlength' => '50']) }}--}}
                                        <input type="text" class="form-control" value="{{ auth()->user()->group_name }}" readonly>
                                        @error('nama_kelompok')
                                            <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Wilayah</label>
                                        {{ Form::text('wilayah', old('wilayah'), ['class' => 'form-control', 'id' => 'wilayah', 'maxlength' => '50','readonly' => true]) }}
                                        @error('wilayah')
                                            <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; <?php echo date('Y'); ?> <span class="text-muted ml-1">Posyandu</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection('content')

@section('js')
    <!-- codeMirror -->
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/xml/xml.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/css/css.js"></script>
    <!-- KaTeX -->
    <script src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js"></script>

    <script type="text/javascript" src='{{ asset('jquery-maxlength/bootstrap-maxlength.js') }}'></script>
    <script>
        $(document).ready(function() {
            $('#title').maxlength()
            $('#sub_title').maxlength()
            $('#illustration').maxlength()
            $('#reporter').maxlength()
            $('#author').maxlength()
            $('#editor').maxlength()
            $('#designer').maxlength()
            $('#slug').maxlength()
        });
    </script>

    <script type="text/javascript" src='{{ asset('filepond/plugin/file-encode/filepond-plugin-file-encode.min.js') }}'>
    </script>
    <script type="text/javascript" src='{{ asset('filepond/plugin/image-resize/filepond-plugin-image-resize.js') }}'>
    </script>
    <script type="text/javascript" src='{{ asset('filepond/plugin/image-preview/filepond-plugin-image-preview.min.js') }}'>
    </script>
    <script type="text/javascript"
        src='{{ asset('filepond/plugin/file-validate-size/filepond-plugin-file-validate-size.js') }}'></script>
    <script type="text/javascript"
        src='{{ asset('filepond/plugin/file-validate-type/filepond-plugin-file-validate-type.js') }}'></script>
    <script type="text/javascript" src='{{ asset('filepond/js/filepond.min.js') }}'></script>

    <script>
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginImageResize,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );

        $(function() {
            const _inputElement = document.querySelector('input[name="avatar"]');
            const _pond = FilePond.create(_inputElement, {
                allowMultiple: false,
                allowFileEncode: true,
                allowFileSizeValidation: true,
                allowFileTypeValidation: true,
                maxFileSize: '3MB',
                labelMaxFileSize: 'Maksimum File Sebesar 3MB',
                fileValidateTypeLabelExpectedTypes: 'Expects {allButLastType} or {lastType}',
                maxFiles: 1,
                required: false,
                maxParallelUploads: 1,
                instantUpload: false,
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg'],
                imagePreviewMaxFileSize: '3MB',
                imagePreviewHeight: 150,
            });

            @if (isset($users))
                @if ($img != null)
                    _pond.addFile('{{ $img }}');
                @else
                @endif
            @else
            @endif

        });
    </script>
@endsection
