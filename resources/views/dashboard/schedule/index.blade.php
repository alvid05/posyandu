@extends('dashboard.template.content')
@section('title', 'Schedule - Assesment')
@section('active-schedule', 'ScheduleController')

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
                    @if(auth()->user()->role_id == 3)
                        <button class="btn btn-primary" data-toggle="modal" data-target="#TambahSchedule">Schedule +</button>
                    @endif
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table align-items-center table-flush small" id="table-content4">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Users</th>
                        <th>Nama Auditor</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        @if(auth()->user()->role_id == 3)
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="list">
                    <!-- ... Tambahkan baris data lainnya -->
                    @foreach($schedule as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('view-assesment') }}">{{ $item->users->name ?? null }}</a></td>
                            <td>{{ $item->audit->name ?? null }}</td>
                            <td>{{ $item->date_start }}</td>
                            <td>{{ $item->date_end }}</td>
                            @if(auth()->user()->role_id == 3)
                                <td>
                                    <a href="{{ route('schedule.delete',$item->id) }}" >
                                        <button class="btn btn-icon btn-sm btn-2 btn-danger upload-file-btn"
                                                data-toggle="modal" data-target="#" @if(now() < $item->date_end)
                                                    disabled @endif>
                                            <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                                        </button>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>

    <div class="modal fade" id="TambahSchedule" tabindex="-1" aria-labelledby="eventmodalTambahSchedule" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px">Tambah Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('schedule.request') }}" method="post" id="">
                        @csrf
                        <div class="form-group">
                            <label for="">Auditor</label>
                            <select class="form-control" name="audit" id="audit" required>
                                <option value="" hidden>--Pilih Auditor--</option>
                                @foreach($audit as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">PIC</label>
                            <select class="form-control" name="pic" id="pic" required>
                                <option value="" hidden>--Pilih PIC--</option>
                                @foreach($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="date_start" id="date_start" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="date_end" id="date_end" required>
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
    <div class="modal fade" id="RejectSchedule" tabindex="-1" aria-labelledby="eventmodalRejectSchedule" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px">Tambah Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('schedule.reject') }}" method="post" id="reject">
                        @csrf
                        <input type="text" name="id" id="id_schedule" hidden>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" name="keterangan_2" id="keterangan_2"></textarea>
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

            window.location.href = '{{ route('schedule.index') }}?year=' + selectedYear;
        }
    </script>

    <script>
        @if(auth()->user()->role_id > 2)
        $('#table-content4').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
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
        $('#table-content4').DataTable();
        @endif

        $('#reject_btn').click(function () {
            var id = $(this).data('id');

            $('#id_schedule').val(id);
        })
    </script>
@endsection


