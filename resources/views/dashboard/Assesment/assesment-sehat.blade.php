@extends('dashboard.template.content')
@section('title', 'Assesment')
@section('active-assesment', 'Assesment')

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
            @if(auth()->user()->role_id == 3)
            <div class="float-right mb-4">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah</button>
            </div>
            @endif
            @if(auth()->user()->role_id == 1)
                <div class="table-responsive mt-4">
                    <table class="table align-items-center table-flush small" id="table-content">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center" colspan="2">Kriteria Program</th>
                            <th scope="col" class="text-center" rowspan="2">Metode Verifikasi</th>
                            <th scope="col" class="text-center" rowspan="2">Nilai</th>
                            <th scope="col" class="text-center" rowspan="2">Deadline</th>
                            @if(auth()->user()->role_id > 1)
                                <th scope="col" class="text-center" rowspan="2">File Dokumen</th>
                            @endif
                            <th scope="col" class="text-center" rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($ass_audit as $item)
                            <tr data-pack="{{ $item->pack }}" data-sub="{{ $item->kriteria_program }}">
                                <td>{{ $item->pack }}</td>
                                <td>{{ $item->kriteria_program }}</td>
                                <td class="text-center">{{ $item->metode_verifikasi }}</td>
                                <td class="text-center">{{ $item->nilai }}</td>
                                <td class="text-center">{{ $item->deadline }}</td>
                                @if(auth()->user()->role_id > 1)
                                    <td class="text-center">
                                        @if(empty($item->file))
                                            -
                                        @else
                                            <a href="{{ asset('file') }}/{{ $item->file }}">
                                                <button class="btn btn-icon btn-sm btn-2 btn-primary" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                @endif
                                <td class="text-center">
                                    @if(auth()->user()->role_id < 2)
                                        @if(!empty($item->file))
                                            @if($item->nilai == 1 AND $item->file)
                                                <button class="btn btn-icon btn-sm btn-2 btn-primary upload-file-btn feedback"
                                                        data-toggle="modal" data-target="#modalInfo" data-id="{{ $item->id_ass }}" data-sub="{{ $item->kriteria_program }}" data-akar="{{ $item->akar_permasalahan }}"
                                                        data-akibat="{{ $item->akibat }}" data-rekomendasi="{{ $item->rekomendasi }}">
                                                    <span class="btn-inner--icon"><i class="fas fa-comment"></i></span>
                                                </button>
                                                <hr style="margin-top: 5px;margin-bottom: 5px">
                                                <div class="badge badge-success">
                                                    <span>Kompeten</span>
                                                </div>
                                            @elseif($item->nilai == 0 AND $item->file)
                                                <button class="btn btn-icon btn-sm btn-2 btn-primary upload-file-btn feedback"
                                                        data-toggle="modal" data-target="#modalInfo" data-id="{{ $item->id_ass }}" data-sub="{{ $item->kriteria_program }}" data-akar="{{ $item->akar_permasalahan }}"
                                                        data-akibat="{{ $item->akibat }}" data-rekomendasi="{{ $item->rekomendasi }}">
                                                    <span class="btn-inner--icon"><i class="fas fa-comment"></i></span>
                                                </button>
                                                <hr style="margin-top: 5px;margin-bottom: 5px">
                                                <div class="badge badge-danger">
                                                    <span>Belum Kompeten</span>
                                                </div>
                                            @elseif(empty($item->file))
                                                <div class="badge badge-warning">
                                                    <span>Waiting for upload file</span>
                                                </div>
                                            @elseif($item->file)
                                                <div class="badge badge-info">
                                                    <span>Waiting for Assessment</span>
                                                </div>
                                            @endif
                                        @else
                                            <button class="btn btn-icon btn-sm btn-2 btn-twitter upload-file-btn"
                                                    data-toggle="modal" data-target="#modalUpload" data-id="{{ $item->id_ass }}">
                                                <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                            </button>
                                        @endif
                                    @elseif(auth()->user()->role_id == 2)
                                        @if(!empty($item->file))
                                            <button type="button" class="btn btn-icon btn-sm btn-2 @if($item->nilai != '-') btn-success @else btn-danger @endif  assign-btn" data-toggle="modal" data-target="#modalUpdate"
                                                    data-id="{{ $item->id_ass }}" data-nama="{{ $item->name }}" data-sub="{{ $item->kriteria_program }}"
                                                    data-akar="{{ $item->akar_permasalahan }}" data-nilai="{{ $item->nilai }}" data-akibat="{{ $item->akibat }}"
                                                    data-rekomendasi="{{ $item->rekomendasi }}">
                                                <span class="btn-inner--icon"><i class="fas fa-sign"></i></span>
                                            </button>
                                        @else
                                            <div class="badge badge-info">
                                                <span>Waiting for user upload file</span>
                                            </div>
                                        @endif
                                    @else
                                        <button class="btn btn-icon btn-sm btn-2 btn-info edit-button" type="button"
                                                data-toggle="modal" data-target="#editModal" data-id="{{ $item->id_ass }}" data-kriteria="{{ $item->kriteria_program }}"
                                                data-nilai="{{ $item->nilai }}" data-pack="{{ $item->pack }}" data-deadline="{{ $item->deadline }}">
                                            <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                        </button>
                                        <form action="{{ route('delete-assesment', $item->id_ass ) }}" class="d-inline">
                                            {{ csrf_field() }}
                                            <button class="btn btn-icon btn-sm btn-2 btn-warning" type="submit">
                                                <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <!-- ... Tambahkan baris data lainnya -->
                        </tbody>
                    </table>
                </div>
            @else
                <div class="table-responsive mt-4">
                    <table class="table align-items-center table-flush small" id="table-content">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center" colspan="2">Kriteria Program</th>
                            <th scope="col" class="text-center" rowspan="2">User</th>
                            <th scope="col" class="text-center" rowspan="2">Metode Verifikasi</th>
                            <th scope="col" class="text-center" rowspan="2">Nilai</th>
                            <th scope="col" class="text-center" rowspan="2">Deadline</th>
                            <th scope="col" class="text-center" rowspan="2">Komentar Setuju (PIC)</th>
                            <th scope="col" class="text-center" rowspan="2">Komentar Tidak Setuju (PIC)</th>
                            @if(auth()->user()->role_id > 1)
                                <th scope="col" class="text-center" rowspan="2">File Dokumen</th>
                            @endif
                            @if(auth()->user()->role_id < 4)
                                <th scope="col" class="text-center" rowspan="2">Action</th>
                            @endif
                        </tr>
                        <tr>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($all->sortBy('pack') as $item)
                            <tr data-pack="{{ $item->pack }}" data-sub="{{ $item->kriteria_program }}">
                                <td>{{ $item->pack }}</td>
                                <td>{{ $item->kriteria_program }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->metode_verifikasi }}</td>
                                <td class="text-center">{{ $item->nilai }}</td>
                                <td class="text-center">{{ $item->deadline }}</td>
                                <td class="text-center">{{ $item->ket_setuju ?? '-' }}</td>
                                <td class="text-center">{{ $item->ket_tidak_setuju ?? '-' }}</td>
                                @if(auth()->user()->role_id > 1)
                                    <td class="text-center">
                                        @if(empty($item->file))
                                            -
                                        @else
                                            <a href="{{ asset('file') }}/{{ $item->file }}">
                                                <button class="btn btn-icon btn-sm btn-2 btn-primary" type="button">
                                                    <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                @endif
                                @if(auth()->user()->role_id < 4)
                                    <td class="text-center">
                                        @if(auth()->user()->role_id == 1)
                                            @if(!empty($item->file))
                                                @if($item->nilai == 1 AND $item->file)
                                                    <button class="btn btn-icon btn-sm btn-2 btn-primary upload-file-btn feedback"
                                                            data-toggle="modal" data-target="#modalInfo" data-id="{{ $item->id_ass }}" data-sub="{{ $item->kriteria_program }}" data-akar="{{ $item->akar_permasalahan }}"
                                                            data-akibat="{{ $item->akibat }}" data-rekomendasi="{{ $item->rekomendasi }}">
                                                        <span class="btn-inner--icon"><i class="fas fa-comment"></i></span>
                                                    </button>
                                                    <hr style="margin-top: 5px;margin-bottom: 5px">
                                                    <div class="badge badge-success">
                                                        <span>Kompeten</span>
                                                    </div>
                                                @elseif($item->nilai == 0 AND $item->file)
                                                    <button class="btn btn-icon btn-sm btn-2 btn-primary upload-file-btn feedback"
                                                            data-toggle="modal" data-target="#modalInfo" data-id="{{ $item->id_ass }}" data-sub="{{ $item->kriteria_program }}" data-akar="{{ $item->akar_permasalahan }}"
                                                            data-akibat="{{ $item->akibat }}" data-rekomendasi="{{ $item->rekomendasi }}">
                                                        <span class="btn-inner--icon"><i class="fas fa-comment"></i></span>
                                                    </button>
                                                    <hr style="margin-top: 5px;margin-bottom: 5px">
                                                    <div class="badge badge-danger">
                                                        <span>Belum Kompeten</span>
                                                    </div>
                                                @elseif(empty($item->file))
                                                    <div class="badge badge-warning">
                                                        <span>Waiting for upload file</span>
                                                    </div>
                                                @elseif($item->file)
                                                    <div class="badge badge-info">
                                                        <span>Waiting for Assessment</span>
                                                    </div>
                                                @endif
                                            @else
                                                <button class="btn btn-icon btn-sm btn-2 btn-twitter upload-file-btn"
                                                        data-toggle="modal" data-target="#modalUpload" data-id="{{ $item->id }}">
                                                    <span class="btn-inner--icon"><i class="fas fa-upload"></i></span>
                                                </button>
                                            @endif
                                        @elseif(auth()->user()->role_id == 2)
                                            @if(!empty($item->file))
                                                <button type="button" class="btn btn-icon btn-sm btn-2 @if($item->nilai != '-') btn-success @else btn-danger @endif  assign-btn" data-toggle="modal" data-target="#modalUpdate"
                                                        data-id="{{ $item->id_ass }}" data-nama="{{ $item->name }}" data-sub="{{ $item->kriteria_program }}"
                                                        data-akar="{{ $item->akar_permasalahan }}" data-nilai="{{ $item->nilai }}" data-akibat="{{ $item->akibat }}"
                                                        data-rekomendasi="{{ $item->rekomendasi }}">
                                                    <span class="btn-inner--icon"><i class="fas fa-sign"></i></span>
                                                </button>
                                            @else
                                                <div class="badge badge-info">
                                                    <span>Waiting for user upload file</span>
                                                </div>
                                            @endif
                                        @else
                                            <button class="btn btn-icon btn-sm btn-2 btn-info edit-button" type="button"
                                                    data-toggle="modal" data-target="#editModal" data-id="{{ $item->id_ass }}" data-kriteria="{{ $item->kriteria_program }}"
                                                    data-nilai="{{ $item->nilai }}" data-rekomendasi="{{ $item->rekomendasi }}" data-akar="{{ $item->akar_permasalahan }}" data-akibat="{{ $item->akibat }}"
                                                    data-pack="{{ $item->pack }}" data-deadline="{{ $item->deadline }}">
                                                <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                            </button>
                                            <a href="{{ route('delete-assesment',$item->id_ass) }}">
                                                <button class="btn btn-icon btn-sm btn-2 btn-warning">
                                                    <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <!-- ... Tambahkan baris data lainnya -->
                        </tbody>
                    </table>
                </div>
            @endif

    </div>
    <div class="card-footer py-4">
        <nav aria-label="...">

        </nav>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputModalLabel">Edit Assesment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route' => 'update-assesment']) }}

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

                        <div class="row">
                            <input type="hidden" id="id-assesment" name="id">
                            <div class="col-lg-6 col-md-6 col">
                                <div class="form-group">
                                    <label class="form-control-label">Kriteria Program</label>
                                    <input type="text" name="pack" id="edit-pack" class='form-control'>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Sub Kriteria</label>
                                    <input type="text" name="kriteria" id="edit-kriteria" class='form-control'>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">nilai</label>
                                    <input type="number" name="nilai" id="edit-nilai" value="{{ old('jml_kader') }}" maxlength="20"
                                           class='form-control'>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col">
                                <div class="form-group">
                                    <label for="">Akar Permasalahan</label>
                                    <textarea name="akar_permasalahan" id="edit-akar_permasalahan" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Akibat</label>
                                    <textarea name="akibat" id="edit-akibat" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Rekomendasi</label>
                                    <textarea name="rekomendasi" id="edit-rekomendasi" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Deadline</label>
                                    <input type="date" name="deadline" id="edit-deadline" value="{{ old('jenis_vaksin') }}"
                                           class='form-control'>
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
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="eventmodalUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulUpdate" style="font-size: 18px"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('update-assesment') }}" method="post" id="formUpdate">
                        @csrf
                        <input type="hidden" name="id" id="id_edit">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input class="form-control" type="text" name="nama" id="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <select name="nilai" class="form-control" id="nilai">
                                <option selected hidden>Pilih Nilai...</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Akar Permasalahan</label>
                            <textarea name="akar_permasalahan" id="akar_permasalahan" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Akibat</label>
                            <textarea name="akibat" id="akibat" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Rekomendasi</label>
                            <textarea name="rekomendasi" id="rekomendasi" class="form-control"></textarea>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="eventmodalTambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px">Tambah Assesment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                        <form action="{{ route('add-assesment') }}" method="post" id="formTambah">
                        @csrf
                        <div class="form-group">
                            <label for="pilihan">Pilihan Kriteria</label>
                            <select id="pilihan" onchange="showHideFields()" class="form-control" required>
                                <option value="" hidden selected>Pilih</option>
                                <option value="kriteriaProgram">Tambah Kriteria Program</option>
                                <option value="subKriteria">Tambah Sub Kriteria</option>
                            </select>
                        </div>
                        <div class="form-group" id="scheduleField" style="display:none;">
                            <label for="schedule">Schedule</label>
                            <select class="form-control" name="schedule" id="schedule" required>
                                <option value="" hidden>--Pilih Schedule--</option>
                                @foreach($schedule as $item)
                                <option value="{{ $item->id }}">PIC : {{ $item->pic->name }}, Tanggal : {{ $item->date_start }} - {{ $item->date_end }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="kriteriaProgramField" style="display:none;">
                            <label for="kriteria">Kriteria Program</label>
                            <input placeholder="Kriteria Program..." class="form-control" type="text" id="kriteria" name="pack" required>
                        </div>
                        <div class="form-group" id="subKriteriaField" style="display:none;">
                            <label for="subKriteria">Kriteria Program</label>
                            <select class="form-control" id="subKriteria" name="pack" required>
                                <!-- Add options dynamically from database -->
                                <option value="" hidden>--Pilih Kriteria--</option>
                                @php
                                $unik = $pack->unique('pack');
                                @endphp
                                @foreach($unik->sortBy('pack') as $item)
                                    <option value="{{ $item->pack }}">{{ $item->pack }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="subField" style="display: none">
                            <label for="">Sub Kriteria</label>
                            <input placeholder="Sub Kriteria..." type="text" name="kriteria" id="sub" required class="form-control">
                        </div>
                        <div class="form-group" style="display: none" id="metode">
                            <label for="metode">Metode Verifikasi</label>
                            <input class="form-control" type="text" name="metode" value="D" readonly>
                        </div>
                        <div class="form-group" style="display: none" id="deadline">
                            <label for="deadline">Deadline</label>
                            <input type="date" class="form-control" name="deadline"  required>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="eventmodalUpload" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px">Upload Assesment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('upload-assesment') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="id" id="upload_id">
                    <div class="form-group">
                        <label for="">Upload File</label>
                        <input type="file" class="form-control" name="file" required>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="eventmodalInfo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulInfo" style="font-size: 18px"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <pre><h3>Akar Permasalahan  : <span class="akar"></span></h3></pre>
                    <pre><h3>Akibat             : <span class="akibat"></span></h3></pre>
                    <pre><h3>Rekomendasi        : <span class="rekomendasi"></span></h3></pre>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="reject" data-toggle="modal" data-target="#modalReject">Tidak Setuju</button>
                    <form action="" id="assesmentForm" method="get">
                        @csrf
                        <button id="btn_aggree" class="btn btn-success" type="submit">Setuju</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalReject" tabindex="-1" aria-labelledby="eventmodalInfo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulInfo" style="font-size: 18px"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="disagreeForm" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea name="tidak_setuju" id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button id="btn_disagree" type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function showHideFields() {
            var selectedOption = document.getElementById('pilihan').value;
            var kriteriaProgramField = document.getElementById('kriteriaProgramField');
            var subKriteriaField = document.getElementById('subKriteriaField');
            var kriteria = document.getElementById('kriteria');
            var subkriteria = document.getElementById('subKriteria');
            var metode = document.getElementById('metode');
            var deadline = document.getElementById('deadline');
            var sub = document.getElementById('subField');
            var schedule = document.getElementById('scheduleField');

            // Hide all fields
            kriteriaProgramField.style.display = 'none';
            subKriteriaField.style.display = 'none';

            // Show the selected field
            if (selectedOption === 'kriteriaProgram') {
                schedule.style.display = 'block';
                kriteriaProgramField.style.display = 'block';
                sub.style.display = 'block';
                metode.style.display = 'block';
                deadline.style.display = 'block';
                kriteria.setAttribute('name','pack');
                kriteria.setAttribute('required','required');
                subkriteria.removeAttribute('required');
                subkriteria.removeAttribute('name');
            } else if (selectedOption === 'subKriteria') {
                schedule.style.display = 'block';
                subKriteriaField.style.display = 'block';
                sub.style.display = 'block';
                metode.style.display = 'block';
                deadline.style.display = 'block';
                subkriteria.setAttribute('name','pack');
                subkriteria.setAttribute('required','required');
                kriteria.removeAttribute('required');
                kriteria.removeAttribute('name');
            }
        }
    </script>

    <script>
        @if(auth()->user()->role_id > 2)
        $(document).ready(function () {
            $('#table-content').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        customize: function (doc) {
                            // Get table element
                            var table = doc.content[1].table;

                            // Set table width to 100% of page width
                            table.widths = Array(table.body[0].length + 1).join('*').split('');

                            // Center align the table
                            table.alignment = 'center';
                        }
                    }
                ],
                select: true
            });
        });
        @endif
        $(document).ready(function () {
            $('#table-content').DataTable();
        });
    </script>

    <script>
        $(document).ready(function (){
            $('.feedback').on('click',function () {
                var id = $(this).data('id');
                var sub = $(this).data('sub');
                var akar = $(this).data('akar');
                var akibat = $(this).data('akibat');
                var rekomendasi = $(this).data('rekomendasi');
                if($(this).data('akar') === ''){
                    akar = '-'
                }
                if($(this).data('akibat') === ''){
                    akibat = '-';
                }
                if ($(this).data('rekomendasi') === ''){
                    rekomendasi = '-';
                }

                $('.akar').text(akar);
                $('.akibat').text(akibat);
                $('.rekomendasi').text(rekomendasi);
                $('#judulInfo').text('Feedback Auditor '+sub);
                $('#assesmentForm').attr('action', '/panel/assesment/aggree/' + id);
                $('#disagreeForm').attr('action', '/panel/assesment/disagree/' + id);
                $('#btn_aggree').on('click',function () {
                    $('#assesmentForm').submit();
                });
                $('#btn_disagree').on('click',function () {
                    $('#disagreeForm').submit();
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('.edit-button').on('click',function () {
                $('#id-assesment').val($(this).data('id'));
                $('#edit-pack').val($(this).data('pack'));
                $('#edit-kriteria').val($(this).data('kriteria'));
                $('#edit-nilai').val($(this).data('nilai'));
                $('#edit-deadline').val($(this).data('deadline'));
                $('#edit-akar_permasalahan').val($(this).data('akar'));
                $('#edit-akibat').val($(this).data('akibat'));
                $('#edit-rekomendasi').val($(this).data('rekomendasi'));
            })

            // Function to update total score and star image
            function updateTotalScore() {
                var totalScore = 0;

                // Iterate through all rows and sum the scores
                $('#table-content tbody tr').each(function () {
                    var nilai = parseFloat($(this).find('td:nth-child(5)').text());  // Assuming the "Nilai" column is the fifth column (index 4)

                    // Check if the value is 1 and limit the total score to 30 assessments
                    if (!isNaN(nilai) && nilai === 1 && totalScore < 30) {
                        totalScore += 3.3;
                    }
                });

                // Display the total score
                $('#total-score').text('Total Nilai :   ' + totalScore.toFixed(2) + '%');

                // Update the star image based on total score
                updateStarImage(totalScore);
            }

            // Function to update star image
            function updateStarImage(totalScore) {
                var starIcon = '';


                // Determine the star emoji based on the total score range
                if (totalScore > 80) {
                    starIcon = '⭐⭐⭐⭐ (Mandiri)';  // Four stars for scores greater than 80
                } else if (totalScore >= 71 && totalScore <= 80) {
                    starIcon = '⭐⭐⭐ (Purnama)';  // Three stars for scores between 71 and 80
                } else if (totalScore >= 60 && totalScore < 71) {
                    starIcon = '⭐⭐ (Madya)';  // Two stars for scores between 60 and 70
                } else {
                    starIcon = '⭐ (Pratama)';  // One star for scores less than 60
                }

                // Display the star emoji
                $('#star-icon').text(starIcon);
            }

            // Call the function on document ready
            updateTotalScore();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.assign-btn').on('click', function () {
                var id = $(this).data('id');
                var sub = $(this).data('sub');
                var nama = $(this).data('nama');
                var akar = $(this).data('akar');
                var akibat = $(this).data('akibat');
                var rekomendasi = $(this).data('rekomendasi');
                var nilai =  $(this).data('nilai');

                $('#id_edit').val(id);
                $('#nama').val(nama);
                $('#judulUpdate').text('Assign '+ sub);
                $('#akar_permasalahan').val(akar);
                $('#akibat').val(akibat);
                $('#rekomendasi').val(rekomendasi);
                if (nilai === 0){
                    $('#nilai option:eq(1)').prop('selected', true);
                }else if(nilai === 1){
                    $('#nilai option:eq(2)').prop('selected', true);
                }else if(nilai === '-'){
                    $('#nilai option:eq(0)').prop('selected', true);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.upload-file-btn').on('click', function () {
                var id = $(this).data('id');
                $('#upload_id').val(id);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Function to handle rowspan logic
            function updateRowspan() {
                var previousPack = null;
                var rowspanCount = 1;

                // Loop through each row in the table
                $('#table-content tbody tr').each(function () {
                    var currentPack = $(this).find('td:first-child').text(); // Assuming the "pack" column is the first column

                    // Check if the current "pack" value is the same as the previous one
                    if (currentPack === previousPack) {
                        rowspanCount++;
                        $(this).find('td:first-child').hide(); // Hide the cell for consecutive rows with the same "pack" value
                    } else {
                        // Update rowspan for the previous row if there were consecutive rows with the same "pack" value
                        if (rowspanCount > 1) {
                            var prevRow = $('#table-content tbody tr[data-pack="' + previousPack + '"]:first');
                            prevRow.find('td:first-child').attr('rowspan', rowspanCount);
                            prevRow.children('td:first-child').show(); // Show the hidden cell in the previous row
                        }

                        // Reset variables for the new "pack" value
                        previousPack = currentPack;
                        rowspanCount = 1;
                    }
                });

                // Update rowspan for the last row if needed
                if (rowspanCount > 1) {
                    var lastRow = $('#table-content tbody tr[data-pack="' + previousPack + '"]:first');
                    lastRow.find('td:first-child').attr('rowspan', rowspanCount);
                    lastRow.children('td:first-child').show(); // Show the hidden cell in the last row
                }
            }

            // Initial call on page load
            updateRowspan();

            // Call the function whenever the DataTables pagination changes
            $('#table-content').on('draw.dt', function () {
                updateRowspan();
            });
        });
    </script>


@endsection


