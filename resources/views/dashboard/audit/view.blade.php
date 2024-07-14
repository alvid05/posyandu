@extends('dashboard.template.content')
@section('title', 'Audit')
@section('active-audit', 'Audit')

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
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mb-4 text-danger">Laporan Sehat</h3>
                <div class="table-responsive mt-4">
                    <table class="table align-items-center table-flush small" id="table-content">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Periode Bulan</th>
                                <th scope="col">Jumlah Kader</th>
                                <th scope="col">Jumlah Balita</th>
                                <th scope="col">Jumlah Ibu Hamil</th>
                                <th scope="col">Jenis Vaksin</th>
                                <th scope="col">Jumlah Vaksin</th>
                                <th scope="col">Inovasi Program</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($laporanSehat as $laporan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $laporan->periode }}</td>
                                    <td>{{ $laporan->jml_kader }}</td>
                                    <td>{{ $laporan->jml_balita }}</td>
                                    <td>{{ $laporan->jml_ibu_hamil }}</td>
                                    <td>{{ $laporan->jenis_vaksin }}</td>
                                    <td>{{ $laporan->jml_vaksin }}</td>
                                    <td>{{ $laporan->inovasi_program }}</td>
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
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3 class=" mt-4 text-danger">Laporan Pintar</h3>
                <div class="table-responsive mt-4">
                    <table class="table align-items-center table-flush small" id="table-content2">
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
                            @foreach ($laporanPintar as $pintar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pintar->periode }}</td>
                                    <td>{{ $pintar->jml_siswa }}</td>
                                    <td>{{ $pintar->jenis_training }}</td>
                                    <td>{{ $pintar->jml_peserta }}</td>
                                    <td>{{ $pintar->inovasi_program }}</td>
                                    <td>{{ $pintar->serapan_industri }}</td>
                                    @if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor')
                                        <td class="text-center" scope="row">
                                            <a href="{{ route('edit-laporan', $pintar->id) }}">
                                                <button class="btn btn-icon btn-sm btn-2 btn-info" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ route('delete-laporan', $pintar->id) }}"
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
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3 class=" mt-4 text-danger">Laporan Hijau</h3>
                <div class="table-responsive mt-4">
                    <table class="table align-items-center table-flush small" id="table-content3">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Periode Bulan</th>
                                <th scope="col">Jumlah Telur Ditemukan</th>
                                <th scope="col">Jumlah Telur Menetas</th>
                                <th scope="col">Jumlah Tukik Dilepaskan</th>
                                <th scope="col">Jumlah Pengunjung</th>
                                <th scope="col">Inovasi Program</th>
                                <th scope="col">Jenis Penyu</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($laporanHijau as $hijau)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hijau->periode }}</td>
                                    <td>{{ $hijau->jml_telur_ditemukan }}</td>
                                    <td>{{ $hijau->jml_telur_menetas }}</td>
                                    <td>{{ $hijau->jml_tukik_dilepas }}</td>
                                    <td>{{ $hijau->jml_pengunjung }}</td>
                                    <td>{{ $hijau->inovasi_program }}</td>
                                    <td>{{ $hijau->jenis_penyu }}</td>
                                    @if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor')
                                        <td class="text-center" scope="row">
                                            <a href="{{ route('edit-laporan', $hijau->id) }}">
                                                <button class="btn btn-icon btn-sm btn-2 btn-info" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ route('delete-laporan', $hijau->id) }}"
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
        </div>
    </div>
    <div class="card-footer py-4">
        <nav aria-label="...">


        </nav>
    </div>

@endsection
