@extends('dashboard.template.app')

@section('css')
    <link rel="stylesheet" type="text/css" href='{{ asset('DataTables/DataTables-1.10.21/css/dataTables.bootstrap4.css') }}' />
    <link rel="stylesheet" type="text/css" href='{{ asset('DataTables/Buttons-1.6.2/css/buttons.bootstrap4.css') }}' />
    <link rel="stylesheet" type="text/css"
        href='{{ asset('DataTables/Responsive-2.2.5/css/responsive.bootstrap4.min.css') }}' />
@endsection


@section('content')
    <!-- Header -->
    <div class="header bg-danger pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        @if (Route::currentRouteName() != 'view-setting-dashboard')
                            @yield('btn-add')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <!-- Light table -->
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">@yield('subtitle')</h3>
                    </div>

                    @yield('card-content')
                </div>

                @yield('another-card')
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
                <div class="col-lg-6">

                </div>
            </div>
        </footer>
    </div>
    </div>
@endsection('content')

@section('js')
    <script type="text/javascript" src='{{ asset('DataTables/JSZip-2.5.0/jszip.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/pdfmake-0.1.36/pdfmake.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/pdfmake-0.1.36/vfs_fonts.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/DataTables-1.10.21/js/jquery.dataTables.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/DataTables-1.10.21/js/dataTables.bootstrap4.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/Buttons-1.6.2/js/dataTables.buttons.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/Buttons-1.6.2/js/buttons.bootstrap4.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/Buttons-1.6.2/js/buttons.html5.js') }}'></script>
    <script type="text/javascript" src='{{ asset('DataTables/Responsive-2.2.5/js/dataTables.responsive.min.js') }}'>
    </script>
    <script type="text/javascript" src='{{ asset('DataTables/Responsive-2.2.5/js/responsive.bootstrap4.min.js') }}'>
    </script>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#table-content').DataTable({
                "language": {
                    search: "<i class='fas fa-search'></i>",
                    "paginate": {
                        "previous": "<i class='fas fa-angle-left'></i>",
                        "next": "<i class='fas fa-angle-right'></i>"
                    }
                }
            });
        });
    </script>
@endsection
