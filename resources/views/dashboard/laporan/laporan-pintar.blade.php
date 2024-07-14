@extends('dashboard.template.content')
@section('title', 'Input Laporan')
@section('active-laporan', 'Input Laporan')

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
        {{ Form::open(['route' => 'add-laporan']) }}

        {{ csrf_field() }}
        <div class="pl-lg-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>Failed!</strong> {{ session('failed') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

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

            <div class="row">
                <div class="col-lg-6 col-md-6 col">
                    <div class="form-group">
                        <label class="form-control-label">Pillar</label>
                        {{ Form::text('jenis_pillar', auth()->user()->jenis_pillar, ['class' => 'form-control', 'id' => 'jenis_pillar', 'maxlength' => '50']) }}
                        @error('jenis_pillar')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Nama Kelompok</label>
                        {{ Form::text('nama_kelompok', auth()->user()->nama_kelompok, ['class' => 'form-control', 'id' => 'nama_kelompok', 'maxlength' => '50']) }}
                        @error('nama_kelompok')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Wilayah</label>
                        {{ Form::text('wilayah', auth()->user()->wilayah, ['class' => 'form-control', 'id' => 'wilayah', 'maxlength' => '50']) }}
                        @error('wilayah')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col">
                    <div class="form-group">
                        <label class="form-control-label">PIC</label>
                        {{ Form::text('nama', auth()->user()->username, ['class' => 'form-control', 'id' => 'nama', 'maxlength' => '50']) }}
                        @error('nama')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Level</label>
                        {{ Form::text('level', null, ['class' => 'form-control', 'id' => 'level', 'readonly' => 'readonly']) }}
                        @error('level')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 col-md-6 col">
                    <div class="form-group">
                        <label class="form-control-label">Periode Bulan</label>
                        <select name="periode" id="periode" class="form-control" required>
                            <option value="" selected>-- Pilih Periode --</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                        @error('periode')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Jumlah Siswa TKR</label>
                        <input type="number" name="jml_siswa" id="jml_siswa" value="{{ old('jml_siswa') }}" maxlength="20"
                            class='form-control'>
                        @error('jml_siswa')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Jenis Training</label>
                        <input type="text" name="jenis_training" id="jenis_training" value="{{ old('jenis_training') }}"
                            maxlength="20" class='form-control'>
                        @error('jenis_training')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Jumlah Peserta</label>
                        <input type="number" name="jml_peserta" id="jml_peserta" value="{{ old('jml_peserta') }}"
                            maxlength="20" class='form-control'>
                        @error('jml_peserta')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col">


                    <div class="form-group">
                        <label class="form-control-label">Inovasi Program</label>
                        <input type="text" name="inovasi_program" id="inovasi_program"
                            value="{{ old('inovasi_program') }}" class='form-control'>
                        @error('inovasi_program')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Serapan Industri</label>
                        <input type="number" name="serapan_industri" id="serapan_industri"
                            value="{{ old('serapan_industri') }}" class='form-control'>
                        @error('serapan_industri')
                            <p class="text-warning small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
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
        <div class="table-responsive mt-4">
            <table class="table align-items-center table-flush small" id="table-content">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Periode Bulan</th>
                        <th scope="col">Jumlah Siswa TKR</th>
                        <th scope="col">Jenis Training</th>
                        <th scope="col">Jumlah Peserta</th>
                        <th scope="col">Inovasi Program</th>
                        <th scope="col">Serapan Industri</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($laporans as $laporan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $laporan->periode }}</td>
                            <td>{{ $laporan->jml_siswa }}</td>
                            <td>{{ $laporan->jenis_training }}</td>
                            <td>{{ $laporan->jml_peserta }}</td>
                            <td>{{ $laporan->inovasi_program }}</td>
                            <td>{{ $laporan->serapan_industri }}</td>
                            @if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor')
                                <td class="text-center" scope="row">
                                    <a href="{{ route('edit-laporan', $laporan->id) }}">
                                        <button class="btn btn-icon btn-sm btn-2 btn-info" type="button">
                                            <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                        </button>
                                    </a>
                                    <form method="POST" action="{{ route('delete-laporan', $laporan->id) }}"
                                        class="d-inline">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-icon btn-sm btn-2 btn-warning" type="submit">
                                            <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                        </button>
                                    </form>
                                </td>
                            @endif

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