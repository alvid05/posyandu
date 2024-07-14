@extends('dashboard.template.content')
@section('title', 'Laporan')
@section('active-laporan', 'Input Laporan')

<style>
    /* Add a CSS class to hide the option */
    .hidden-option {
        display: none;
    }
</style>

<style>
    /* Sembunyikan elemen input bawaan */
    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }
    input[type="date"] {
        -moz-appearance: textfield;
    }
</style>

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
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <select class="form-control w-75" id="yearSelect" onchange="changeYear(this.value)">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8">
            </div>
            <div class="col-md-2 text-center">
                @if(auth()->user()->role_id < 4)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#inputModal">Laporan +</button>
                @endif
            </div>
        </div>
        <div class="table-responsive mt-6">
            <table class="table align-items-center table-flush small" id="table-content-2">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Periode Bulan</th>
                    @if(auth()->user()->role_id > 1)
                        <th scope="col">User</th>
                    @endif
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
                @foreach ($laporans as $laporan)
                    <tr data-bulan="{{ $laporan->periode }}">
                        <td>{{ $laporan->periode }}</td>
                        @if(auth()->user()->role_id > 1)
                            <td>{{ $laporan->user->name ?? null }}</td>
                        @endif
                        <td>{{ $laporan->jml_kader }}</td>
                        <td>{{ $laporan->jml_balita }}</td>
                        <td>{{ $laporan->jml_ibu_hamil }}</td>
                        <td>{{ $laporan->jenis_vaksin }}</td>
                        <td>{{ $laporan->jml_vaksin }}</td>
                        <td>{{ $laporan->inovasi_program }}</td>
                            <td class="text-center" scope="row">
                                <button class="btn btn-icon btn-sm btn-2 btn-info edit-button" type="button"
                                data-toggle="modal" data-target="#editModal"data-id="{{ $laporan->id }}" data-posyandu="{{ $laporan->posyandu }}"
                                data-periode="{{ $laporan->periode }}" data-kader="{{ $laporan->jml_kader }}" data-balita="{{ $laporan->jml_balita }}"
                                data-bumil="{{ $laporan->jml_ibu_hamil }}" data-vaksin="{{ $laporan->jml_vaksin }}" data-inovasi="{{ $laporan->inovasi_program }}"
                                data-jnsV="{{ $laporan->jenis_vaksin }}" data-area="{{ $laporan->area }}">
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
                        <form action="{{ route('add-laporan') }}" method="post" id="formAdd">
                        @csrf
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
                                            <option value="{{ $item->id }}" data-posyandu="{{ $item->group_name }}" data-area="{{ $item->wilayah }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('posyandu')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-control-label">Posyandu</label>
                                        <input type="text" @if(auth()->user()->role_id < 2) readonly value="{{ auth()->user()->group_name }}" @endif name="posyandu" id="posyandu" class='form-control'>
                                        @error('posyandu')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Area</label>
                                        <input type="text" name="area" id="area" class='form-control'>
                                        @error('area')
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
                                        <label class="form-control-label">Tahun</label>
                                        <select class="form-control" id="tahun" name="tahun"></select>
                                        @error('jml_kader')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Kader</label>
                                        <input type="number" name="jml_kader" id="jml_kader" value="{{ old('jml_kader') }}" maxlength="20"
                                               class='form-control'>
                                        @error('jml_kader')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col">
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Balita</label>
                                        <input type="number" name="jml_balita" id="jml_balita" value="{{ old('jml_balita') }}"
                                               maxlength="20" class='form-control'>
                                        @error('jml_balita')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Ibu Hamil</label>
                                        <input type="number" name="jml_ibu_hamil" id="jml_ibu_hamil"
                                               value="{{ old('jml_ibu_hamil') }}" maxlength="20" class='form-control'>
                                        @error('jml_ibu_hamil')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jenis Vaksin</label>
                                        <input type="text" name="jenis_vaksin" id="jenis_vaksin" value="{{ old('jenis_vaksin') }}"
                                               class='form-control'>
                                        @error('jenis_vaksin')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Vaksin</label>
                                        <input type="number" name="jml_vaksin" id="jml_vaksin"
                                               value="{{ old('jml_vaksin') }}" maxlength="20" class='form-control'>
                                        @error('jml_vaksin')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Inovasi Program</label>
                                        <input type="text" name="inovasi_program" id="inovasi_program"
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
                                        <label class="form-control-label">Posyandu</label>
                                        <input type="text" name="posyandu" id="edit-posyandu" class='form-control' readonly>
                                        @error('posyandu')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Area</label>
                                        <input type="text" name="area" id="edit-area" class='form-control'>
                                        @error('area')
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
                                        <label class="form-control-label">Jumlah Kader</label>
                                        <input type="number" name="jml_kader" id="edit-jml_kader" value="{{ old('jml_kader') }}" maxlength="20"
                                               class='form-control'>
                                        @error('jml_kader')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col">
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Balita</label>
                                        <input type="number" name="jml_balita" id="edit-jml_balita" value="{{ old('jml_balita') }}"
                                               maxlength="20" class='form-control'>
                                        @error('jml_balita')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Ibu Hamil</label>
                                        <input type="number" name="jml_ibu_hamil" id="edit-jml_ibu_hamil"
                                               value="{{ old('jml_ibu_hamil') }}" maxlength="20" class='form-control'>
                                        @error('jml_ibu_hamil')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jenis Vaksin</label>
                                        <input type="text" name="jenis_vaksin" id="edit-jenis_vaksin" value="{{ old('jenis_vaksin') }}"
                                               class='form-control'>
                                        @error('jenis_vaksin')
                                        <p class="text-warning small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Vaksin</label>
                                        <input type="number" name="jml_vaksin" id="edit-jml_vaksin"
                                               value="{{ old('jml_vaksin') }}" maxlength="20" class='form-control'>
                                        @error('jml_vaksin')
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
        function changeYear(selectedYear) {
            // You can perform additional actions here if needed
            // For example, you might want to make an AJAX request to update the charts based on the selected year
            // Replace the following line with your AJAX request logic

            window.location.href = '{{ route('add-laporan') }}?year=' + selectedYear;
        }
    </script>

    <script>
        $(document).ready(function() {
            var currentYear = new Date().getFullYear();

            // Mengisi pilihan tahun dalam rentang tertentu (misalnya, 20 tahun ke belakang hingga 10 tahun ke depan)
            for (var i = currentYear; i >= currentYear - 5; i--) {
                $("#tahun").append("<option value='" + i + "'>" + i + "</option>");
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            // Tangkap perubahan pada elemen select dengan id 'pic'
            $('#pic').change(function () {
                // Ambil data yang terkait dengan opsi yang dipilih
                var selectedOption = $(this).find(':selected');
                var posyanduValue = selectedOption.data('posyandu');
                var areaValue = selectedOption.data('area');

                // Setel nilai posyandu dan area sesuai dengan data yang diambil
                $('#posyandu').val(posyanduValue);
                $('#area').val(areaValue);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var previousPack = null;
            var rowspanCount = 1;

            // Loop through each row in the table
            $('#table-content-2 tbody tr').each(function () {
                var currentPack = $(this).find('td:first-child').text(); // Assuming the "pack" column is the first column

                // Check if the current "pack" value is the same as the previous one
                if (currentPack === previousPack) {
                    rowspanCount++;
                    $(this).find('td:first-child').remove(); // Remove the cell for consecutive rows with the same "pack" value
                } else {
                    // Update rowspan for the previous row if there were consecutive rows with the same "pack" value
                    if (rowspanCount > 1) {
                        $('#table-content-2 tbody tr[data-bulan="' + previousPack + '"]:first').find('td:first-child').attr('rowspan', rowspanCount);
                    }

                    // Reset variables for the new "pack" value
                    previousPack = currentPack;
                    rowspanCount = 1;
                }
            });

            // Update rowspan for the last row if needed
            if (rowspanCount > 1) {
                $('#table-content-2 tbody tr[data-bulan="' + previousPack + '"]:first').find('td:first-child').attr('rowspan', rowspanCount);
            }
        });
    </script>

    <script>
        @if(auth()->user()->role_id > 2)
        $('#table-content-2').dataTable({
            "ordering": false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
        @else
        $('#table-content-2').dataTable({
            "ordering": false
        });
        @endif

        $(document).ready(function () {
            // Menggunakan class .edit-button untuk menghandle klik pada tombol edit
            $('.edit-button').on('click', function () {
                // Mengambil nilai data dari elemen yang diklik
                var id = $(this).data('id');
                var posyandu = $(this).data('posyandu');
                var area = $(this).data('area');
                var periode = $(this).data('periode');
                var jmlKader = $(this).data('kader');
                var jmlBalita = $(this).data('balita');
                var jmlIbuHamil = $(this).data('bumil');
                var jenisVaksin = $(this).data('jnsv');
                var jmlVaksin = $(this).data('vaksin');
                var inovasiProgram = $(this).data('inovasi');

                // Mengatur nilai input pada form modal
                $('#id-laporan').val(id);
                $('#edit-posyandu').val(posyandu);
                $('#edit-area').val(area);
                $('#edit-periode').val(periode);
                $('#edit-jml_kader').val(jmlKader);
                $('#edit-jml_balita').val(jmlBalita);
                $('#edit-jml_ibu_hamil').val(jmlIbuHamil);
                $('#edit-jenis_vaksin').val(jenisVaksin);
                $('#edit-jml_vaksin').val(jmlVaksin);
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


