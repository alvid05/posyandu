@extends('dashboard.template.content')
@section('active-ums', 'active')
@section('expanded-ums', 'true')
@section('show-ums', 'show')
@section('show-ums-users', 'show')
@section('title', 'User Management')
@section('subtitle', 'Users')

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

@section('card-content')
    <!-- Light table -->
    <div class="card-body">
        @if (isset($users))
            {{ Form::model($users, ['route' => ['update-ums-users', $users->id], 'method' => 'POST','enctype' => 'multipart/form-data']) }}
        @else
            {{ Form::open(['route' => 'store-ums-users', 'method' => 'POST','enctype' => 'multipart/form-data']) }}
        @endif

        {{ csrf_field() }}
        <div class="pl-lg-4">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-air-baloon"></i></span>
                    <span class="alert-text"><strong>Gagal!</strong> Data gagal diinputkan, silahkan cek form
                        kembali!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="form-group">
                <label class="form-control-label">Nama Lengkap</label>
                @if(isset($users))
                    <input type="text" value="{{ $users->name }}" class="form-control" name="username" id="username" maxlength="50" required>
                @else
                    <input type="text" class="form-control" name="username" id="username" maxlength="50" required>
                @endif
                @error('username')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control-label">E-mail</label>
                {{ Form::text('email', old('email'), ['name' => 'email','class' => 'form-control', 'id' => 'email', 'maxlength' => '20','required'=> true]) }}
                @error('email')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            @if(isset($users))
                <div class="form-group">
                    <label class="form-control-label">Password</label>
                    <input type="password" name="password" id="password" value="" maxlength="20"
                           class='form-control'>
                    @error('password')
                    <p class="text-warning small">{{ $message }}</p>
                    @enderror
                    <p class="text-warning small mt-1">Kosongkan Password dan Confirm Password jika tidak ingin diubah</p>
                </div>
            @else
                <div class="form-group">
                    <label class="form-control-label">Password</label>
                    <input type="password" name="password" id="password" value="" maxlength="20"
                           class='form-control' required>
                    @error('password')
                    <p class="text-warning small">{{ $message }}</p>
                    @enderror
                    <p class="text-warning small mt-1"></p>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}"
                           maxlength="20" class='form-control' required>
                    @error('confirm_password')
                    <p class="text-warning small">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label class="form-control-label">Roles</label>
                @if(!isset($users))
                    {{ Form::select('role_id', ['' => 'Selected Answer'] + $option_role, old('role_id'), [
                         'class' => 'form-control', 'name' => 'role_id', 'id' => 'role_id','required'=>true
                    ]) }}
                @else
                    {{ Form::select('role_id',$option_role, old('role_id'), [
                         'class' => 'form-control', 'name' => 'role_id', 'id' => 'role_id'
                    ]) }}
                @endif
                @error('role_id')
                <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control-label">Avatar</label>
                {{ Form::file('avatar', ['class' => 'form-control','name' => 'avatar']) }}
            </div>
            <div class="form-group" id="form_pic">
                <label class="form-control-label">Jenis Pilar</label>
                @if (isset($users))
                    <select name="jenis_pilar" id="jenis_pilar" class="form-control" required>
                        <option value="" hidden>Pilih Jenis Pilar</option>
                        @foreach($kategori as $item)
                            <option @if ($users->categoryPillar->id == $item->id) selected @endif value="{{ $item->id }}" data-category-id="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                @else
                    <select name="jenis_pilar" id="jenis_pilar" class="form-control" required>
                        <option value="" hidden>Pilih Jenis Pilar</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}" data-category-id="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                @endif
                @error('jenis_pilar')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="row" id="form_pic2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Nama Kelompok</label>
                        @if(isset($users))
                            <input type="text" name="nama_kelompok" class="form-control" id="nama_kelompok" maxlength="50" value="{{ $users->group_name }}" required>
                        @else
                            <input type="text" name="nama_kelompok" class="form-control" id="nama_kelompok" maxlength="50" required>
                        @endif

                        @error('nama_kelompok')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Wilayah</label>
                        {{ Form::text('wilayah', old('wilayah'), ['name' => 'wilayah','class' => 'form-control', 'id' => 'wilayah', 'maxlength' => '50','required' => true]) }}
                        @error('wilayah')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-control-label">Is Users Active?</label>
                @if(!isset($users))
                    {{ Form::select(
                        'is_active',
                        ['' => 'Selected Answer', 'Active' => 'Yes', 'Inactive' => 'No'],
                        old('is_active'),
                        ['class' => 'form-control', 'name' => 'is_active', 'id' => 'is_active','required'=>true]
                    ) }}
                @else
                    {{ Form::select(
                        'is_active',
                        ['Active' => 'Yes', 'Inactive' => 'No'],
                        old('is_active'),
                        ['class' => 'form-control', 'name' => 'is_active','required'=>true]
                    ) }}
                @endif
                @error('is_active')
                    <p class="text-warning small">{{ $message }}</p>
                @enderror
            </div>

            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">

                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="submit" class="btn btn-danger">Submit</button>
                    <button type="button" class="btn btn-outline-danger" onclick="history.go(-1);">Cancel</button>
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
    <script type="text/javascript" src='{{ asset('sun-editor/js/common.js') }}'></script>
    <script type="text/javascript" src='{{ asset('sun-editor/js/suneditor.min.js') }}'></script>
    <!-- codeMirror -->
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/xml/xml.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/css/css.js"></script>
    <!-- KaTeX -->
    <script src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js"></script>

    <script>
        $(document).ready(function () {
            // Listen for changes in the "Roles" select
            $('#role_id').change(function () {
                toggleAuditorVisibility();
            });

            // Initial call to set the visibility based on the initial value of "Roles" select
            toggleAuditorVisibility();

            function toggleAuditorVisibility() {
                // Get the selected role
                var selectedRole = $('#role_id').val();

                // Check if the selected role is "Pic"
                if (selectedRole !== '1') { // Assuming '1' is the correct value for "Pic"
                    // If "Pic" is selected, show the "Auditor" select
                    $('#form_pic').css('display', 'none');
                    $('#form_pic2').css('display', 'none');
                    // Make the "Auditor" select required
                    $('#jenis_pilar').prop('required', false);
                    $('#nama_kelompok').prop('required', false);
                    $('#wilayah').prop('required', false);
                } else {
                    $('#form_pic').css('display', 'block');
                    $('#form_pic2').css('display', 'block');
                    // Make the "Auditor" select required
                    $('#jenis_pilar').prop('required', true);
                    $('#nama_kelompok').prop('required', true);
                    $('#wilayah').prop('required', true);
                }
            }
        });
    </script>

    <script>

        $(document).ready(function () {
            // Set 'Selected Answer' as the default selected option
            $('#role_id option:contains("Selected Answer")').prop('selected', true);

            // Hide the 'Selected Answer' option
            $('#role_id option:contains("Selected Answer")').hide();

            // Set 'Selected Answer' as the default selected option
            $('#is_active option:contains("Selected Answer")').prop('selected', true);

            // Hide the 'Selected Answer' option
            $('#is_active option:contains("Selected Answer")').hide();
        });
    </script>

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

@endsection
