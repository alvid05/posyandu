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
        @if(auth()->user()->role_id < 4)
            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#inputModal">Laporan +</button>
        @endif
        <div class="table-responsive mt-6">
            <table class="table align-items-center table-flush small" id="table-content-3">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Periode Bulan</th>
                    @if(auth()->user()->role_id > 1)
                        <th scope="col">User</th>
                    @endif
                    <th scope="col">Jumlah Telur Ditemukan</th>
                    <th scope="col">Jumlah Telur Menetas</th>
                    <th scope="col">Jumlah Tukik Dilepas</th>
                    <th scope="col">Jumlah Pengunjung</th>
                    <th scope="col">Jenis Penyu</th>
                    <th scope="col">Inovasi Program</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody class="list">
                @foreach ($laporans as $laporan)
                    <tr data-bulan="{{ $laporan->periode }}">
                        <td>{{ $laporan->periode }}</td>
                        @if(auth()->user()->role_id > 1)
                            <td>{{ $laporan->user->name }}</td>
                        @endif
                        <td>{{ $laporan->jml_telur_ditemukan }}</td>
                        <td>{{ $laporan->jml_telur_menetas }}</td>
                        <td>{{ $laporan->jml_tukik_dilepas }}</td>
                        <td>{{ $laporan->jml_pengunjung }}</td>
                        <td>{{ $laporan->jenis_penyu }}</td>
                        <td>{{ $laporan->inovasi_program }}</td>
                        <td class="text-center" scope="row">
                            <button class="btn btn-icon btn-sm btn-2 btn-info edit-button" type="button"
                                    data-toggle="modal" data-target="#editModal"data-id="{{ $laporan->id }}" data-konversi="{{ $laporan->konservasi_penyu }}"
                                    data-periode="{{ $laporan->periode }}" data-tk="{{ $laporan->jml_telur_ditemukan }}" data-tm="{{ $laporan->jml_telur_menetas }}"
                                    data-tukik="{{ $laporan->jml_tukik_dilepas }}" data-pengunjung="{{ $laporan->jml_pengunjung }}" data-inovasi="{{ $laporan->inovasi_program }}"
                                    data-penyu="{{ $laporan->jenis_penyu }}">
                                <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                            </button>
                            <form method="POST" action="{{ route('delete-laporan', $laporan->id) }}"
                                  class="d-inline">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
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
        <!-- Your existing form modal -->
        <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputModalLabel">Input Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(['route' => 'add-laporan','onsubmit' => 'hideSelectedMonth()','method' => 'post']) }}

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
                                    @if(auth()->user()->role_id == 3)
                                        <div class="form-group">
                                            <label class="form-control-label">PIC</label>
                                            <select name="pic" id="pic" class="form-control" required>
                                                <option selected hidden>Select Users</option>
                                                @foreach($users as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('posyandu')
                                            <p class="text-warning small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-control-label">Konversi Penyu</label>
                                        <input type="text" @if(auth()->user()->role_id < 2) readonly value="{{ auth()->user()->group_name }}" @endif name="konversi" id="konversi" class='form-control'>
                                        @error('posyandu')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Periode Bulan</label>
                                        <select name="periode" id="periode" class="form-control" required>
                                            <option selected hidden="">-- Pilih Periode --</option>
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
                                        <label class="form-control-label">Jumlah Telur Ditemukan</label>
                                        <input type="number" name="jml_telur_ditemukan" id="jml_telur_ditemukan"  maxlength="20"
                                               class='form-control'>
                                        @error('jml_kader')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col">
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Telur Menetas</label>
                                        <input type="number" name="jml_telur_menetas" id="jml_telur_menetas"
                                               maxlength="20" class='form-control'>
                                        @error('jml_balita')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Tukik Dilepas</label>
                                        <input type="number" name="jml_tukik_dilepas" id="jml_tukik_dilepas" maxlength="20" class='form-control'>
                                        @error('jml_ibu_hamil')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Pengunjung</label>
                                        <input type="number" name="jml_pengunjung" id="jml_pengunjung" maxlength="20" class='form-control'>
                                        @error('jml_ibu_hamil')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jenis Penyu</label>
                                        <input type="text" name="jenis_penyu" id="jenis_penyu"
                                               class='form-control'>
                                        @error('jenis_vaksin')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Inovasi Program</label>
                                        <input type="text" name="inovasi_program" id="inovasi_program"
                                               class='form-control'>
                                        @error('inovasi_program')
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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputModalLabel">Edit Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(['route' => 'edit-laporan']) }}

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
                                <input type="hidden" id="id-laporan" name="id">
                                <div class="col-lg-6 col-md-6 col">
                                    <div class="form-group">
                                        <label class="form-control-label">Konversi Penyu</label>
                                        <input type="text" name="konversi_penyu" id="edit-konversi_penyu" class='form-control' readonly>
                                        @error('posyandu')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Periode Bulan</label>
                                        <select name="periode" id="edit-periode" class="form-control" required>
                                            <option selected hidden="">-- Pilih Periode --</option>
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
                                        <label class="form-control-label">Jumlah Telur Ditemukan</label>
                                        <input type="number" name="jml_telur_ditemukan" id="edit-jml_telur_ditemukan" value="{{ old('jml_telur_ditemukan') }}" maxlength="20"
                                               class='form-control'>
                                        @error('jml_telur_ditemukan')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col">
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Telur Menetas</label>
                                        <input type="number" name="jml_telur_menetas" id="edit-jml_telur_menetas" value="{{ old('jml_telur_menetas') }}"
                                               maxlength="20" class='form-control'>
                                        @error('jml_telur_menetas')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Tukik Lepas</label>
                                        <input type="number" name="jml_tukik_dilepas" id="edit-jml_tukik_dilepas"
                                               value="{{ old('jml_tukik_dilepas') }}" maxlength="20" class='form-control'>
                                        @error('jml_tukik_dilepas')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Pengunjung</label>
                                        <input type="number" name="jml_pengunjung" id="edit-jml_pengunjung"
                                               value="{{ old('jml_pengunjung') }}" maxlength="20" class='form-control'>
                                        @error('jml_pengunjung')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jenis Penyu</label>
                                        <input type="text" name="jenis_penyu" id="edit-jenis_penyu" value="{{ old('jenis_penyu') }}"
                                               class='form-control'>
                                        @error('jenis_penyu')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Inovasi Program</label>
                                        <input type="text" name="inovasi_program" id="edit-inovasi_program"
                                               value="{{ old('inovasi_program') }}" class='form-control'>
                                        @error('inovasi_program')
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer py-4">
        <nav aria-label="...">


        </nav>
    </div>

@endsection


@section('js')

    <script>
        function hideSelectedMonth() {
            // Get the selected option
            var selectedOption = document.getElementById('periode').value;

            // Add a class to the selected option
            var selectElement = document.getElementById('periode');
            for (var i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value === selectedOption) {
                    selectElement.options[i].classList.add('hidden-option');
                    break;
                }
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            var previousPack = null;
            var rowspanCount = 1;

            // Loop through each row in the table
            $('#table-content-3 tbody tr').each(function () {
                var currentPack = $(this).find('td:first-child').text(); // Assuming the "pack" column is the first column

                // Check if the current "pack" value is the same as the previous one
                if (currentPack === previousPack) {
                    rowspanCount++;
                    $(this).find('td:first-child').remove(); // Remove the cell for consecutive rows with the same "pack" value
                } else {
                    // Update rowspan for the previous row if there were consecutive rows with the same "pack" value
                    if (rowspanCount > 1) {
                        $('#table-content-3 tbody tr[data-bulan="' + previousPack + '"]:first').find('td:first-child').attr('rowspan', rowspanCount);
                    }

                    // Reset variables for the new "pack" value
                    previousPack = currentPack;
                    rowspanCount = 1;
                }
            });

            // Update rowspan for the last row if needed
            if (rowspanCount > 1) {
                $('#table-content-3 tbody tr[data-bulan="' + previousPack + '"]:first').find('td:first-child').attr('rowspan', rowspanCount);
            }
        });
    </script>

    <script>
        $('#table-content-3').dataTable({
            "ordering": false,
        });

        $(document).ready(function () {
            // Menggunakan class .edit-button untuk menghandle klik pada tombol edit
            $('.edit-button').on('click', function () {
                // Mengambil nilai data dari elemen yang diklik
                var id = $(this).data('id');
                var konversi = $(this).data('konversi');
                var periode = $(this).data('periode');
                var jmltk = $(this).data('tk');
                var jmltm = $(this).data('tm');
                var jmltukik = $(this).data('tukik');
                var jmlpengunjung = $(this).data('pengunjung');
                var jenis = $(this).data('penyu');
                var inovasiProgram = $(this).data('inovasi');

                // Mengatur nilai input pada form modal
                $('#id-laporan').val(id);
                $('#edit-konversi_penyu').val(konversi);
                $('#edit-periode').val(periode);
                $('#edit-jml_telur_ditemukan').val(jmltk);
                $('#edit-jml_telur_menetas').val(jmltk);
                $('#edit-jml_tukik_dilepas').val(jmltukik);
                $('#edit-jml_pengunjung').val(jmlpengunjung);
                $('#edit-jenis_penyu').val(jenis);
                $('#edit-inovasi_program').val(inovasiProgram);

                // Menetapkan opsi yang terpilih pada dropdown periode
                $('#edit-periode option').each(function () {
                    if ($(this).val() === periode) {
                        $(this).prop('selected', true);
                    } else {
                        $(this).prop('selected', false);
                    }
                });
            });
        });
    </script>
@endsection
