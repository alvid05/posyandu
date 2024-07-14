@extends('dashboard.template.app')
@section('title', 'Dashboard')
@section('active-dashboard', 'active')

@section('content')
    <div class="header bg-danger pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- Card stats -->

            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">

        <div class="row mb-4">

            <div class="col-lg-3">
                <button class="card card-stats category-btn hijau">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Penerima Manfaat (people)</h5>
                                <span class="h2 font-weight-bold mb-0">{{ array_sum([$totalTelurDitemukan,$totalTelurMenetas,$totalTukikDilepas,$totalPengunjung])  }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-red text-white">
                                    <img class="rounded-circle shadow" src="{{ asset('dashboard/assets/img/hijau.jpg') }}"
                                         alt="" height="55px">
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </div>

            <div class="col-lg-3">
                <button class="card card-stats category-btn sehat">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Penerima Manfaat (People)</h5>
                                <span class="h2 font-weight-bold mb-0">{{ array_sum([$totalBalita,$totalKader,$totalIbuHamil]) ?? null  }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-red text-white">
                                    <img class="rounded-circle shadow" src="{{ asset('dashboard/assets/img/sehat.jpg') }}"
                                         alt="" height="55px">
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </div>
        <div class="col-lg-3">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Penerima Manfaat (people)</h5>
                                <span class="h2 font-weight-bold mb-0">2,356</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-red text-white">
                                    <img class="rounded-circle shadow" src="{{ asset('dashboard/assets/img/pintar.jpg') }}"
                                        alt="" height="55px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Penerima Manfaat (people)</h5>
                                <span class="h2 font-weight-bold mb-0">2,356</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-red text-white">
                                    <img class="rounded-circle shadow"
                                        src="{{ asset('dashboard/assets/img/sejahtera.jpg') }}" alt=""
                                        height="55px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="form-group">
                        <label for="yearSelect">Select Year:</label>
                        <select class="form-control" id="yearSelect" onchange="changeYear(this.value)">
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="display: block" id="chartSehat">
            <div class="col">
                <div class="card">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartBalita" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartKader" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartIbuHamil" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartVaksin" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="display: block" id="chartHijau">
            <div class="col">
                <div class="card">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartTelurDitemukan" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartTelurMenetas" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartTukikDilepas" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class=" ml-2">
                                <canvas id="chartPengunjung" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
                <div class="table-responsive mt-4 pl-4 pr-4 mb-4">
                    <table class="table align-items-center table-flush small" id="table-content-assign">
                        <thead class="thead-light">
                        <tr>
                            <th>Nama Mitra</th>
                            <th class="text-center">Total Assesment</th>
                            <th class="text-center">Point</th>
                            <th class="text-center">Level</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($user as $item)
                            <tr>
                                <td>{{ $item->schedule->user->group_name ?? null }}</td>
                                <td class="text-center">{{ $item->total ?? 0 }}</td>
                                <td class="text-center" id="point"></td>
                                <td class="text-center" id="level"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
@endsection
@section('js')
    <script>
        function changeYear(selectedYear) {
            // You can perform additional actions here if needed
            // For example, you might want to make an AJAX request to update the charts based on the selected year
            // Replace the following line with your AJAX request logic

            window.location.href = '{{ route('view-dashboard') }}?year=' + selectedYear;
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add event listeners to category buttons
            var categoryButtons = document.querySelectorAll('.category-btn');
            categoryButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Get the category from the button class
                    var category = this.classList.contains('hijau') ? 'hijau' : 'sehat';

                    // Hide all charts
                    hideAllCharts();

                    // Show charts based on the selected category
                    if (category === 'sehat') {
                        document.getElementById('chartSehat').style.display = 'block';
                        document.getElementById('chartHijau').style.display = 'none';
                    } else if (category === 'hijau') {
                        document.getElementById('chartSehat').style.display = 'none';
                        document.getElementById('chartHijau').style.display = 'block';
                    }
                });
            });

            // Function to hide all charts
            function hideAllCharts() {
                // Set all charts' display to 'none'
                var chartElements = document.querySelectorAll('.chart-container canvas');
                chartElements.forEach(function (chart) {
                    chart.style.display = 'none';
                });
            }
        });

    </script>

    <script>
        @if(auth()->user()->role_id > 2)
        $(document).ready(function () {
            $('#table-content-assign').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ]
            });
        });
        @endif
        $(document).ready(function () {
           $('#table-content-assign').DataTable();
        });
    </script>

<script>
    // Function to update total score and star image
    function updateTotalScore() {
        var totalScore = 0;

        // Iterate through all rows and calculate points and levels
        $('#table-content-assign tbody tr').each(function () {
            var nilai = parseFloat($(this).find('td:nth-child(2)').text());  // Assuming the "Total Assesment" column is the second column (index 1)

            // Calculate point and level
            var point = 0;
            var level = '';

            if (!isNaN(nilai) && nilai === 1) {
                point = 3.3;
            }

            if (point > 80) {
                level = 'Purnama';
            } else if (point >= 60 && point <= 80) {
                level = 'Madya';
            } else {
                level = 'Pratama';
            }

            // Update point and level columns in the current row
            var starIcon = getStarIcon(point);
            $(this).find('td:nth-child(3)').html(starIcon);
            $(this).find('td:nth-child(4)').text(level);

            // Add the calculated point to the total score
            totalScore += point;
        });

        // Display the total score
        $('#total-score').text('Total Nilai :   ' + totalScore.toFixed(2) + '%');

        // Update the star image based on total score
        updateStarImage(totalScore);
    }

    // Function to get star icon based on point value
    function getStarIcon(point) {
        var starIcon = '';

        // Determine the star emoji based on the point value
        if (point > 80) {
            starIcon = '⭐⭐⭐⭐';
        } else if (point >= 71 && point <= 80) {
            starIcon = '⭐⭐⭐';
        } else if (point >= 60 && point < 71) {
            starIcon = '⭐⭐';
        } else {
            starIcon = '⭐';
        }

        return starIcon;
    }

    // Function to update star image
    function updateStarImage(totalScore) {
        var starIcon = getStarIcon(totalScore);

        // Display the star emoji
        $('#star-icon').text(starIcon);
    }

    // Call the function on document ready
    $(document).ready(function () {
        updateTotalScore();
    });
</script>


    <script type="text/javascript">
        var chartDataBalita = @php echo json_encode($chartDataBalita); @endphp;
        var chartDataKader =  @php echo json_encode($chartDataKader); @endphp;
        var chartDataIbuHamil = @php echo json_encode($chartDataIbuHamil); @endphp;
        var chartDataVaksin = @php echo json_encode($chartDataVaksin); @endphp;
        var labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Chart for Balita
        new Chart(document.getElementById("chartBalita"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataBalita,
                    label: "Jumlah Penerima Manfaat (Balita) Sehat Bersama Daihatsu",
                    backgroundColor: "blue",
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Penerima Manfaat (Balita) Sehat Bersama Daihatsu'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });

        // Chart for Kader
        new Chart(document.getElementById("chartKader"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataKader,
                    label: "Jumlah Penerima Manfaat (Kader) Sehat Bersama Daihatsu",
                    backgroundColor: "#E98D42",
                    borderColor: "#3e95cd",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Penerima Manfaat (Kader) Sehat Bersama Daihatsu'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });

        // Chart for Ibu Hamil
        new Chart(document.getElementById("chartIbuHamil"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataIbuHamil,
                    label: "Jumlah Penerima Manfaat (Ibu Hamil) Sehat Bersama Daihatsu",
                    backgroundColor: "#B76e79",
                    borderColor: "#B76e79",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Penerima Manfaat (Ibu Hamil) Sehat Bersama Daihatsu'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });

        // Chart for Ibu Hamil
        new Chart(document.getElementById("chartVaksin"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataVaksin,
                    label: "Jumlah Vaksin Sehat Bersama Daihatsu",
                    backgroundColor: "#ffc0cb",
                    borderColor: "#ffc0cb",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Vaksin Sehat Bersama Daihatsu'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });
    </script>

    <script type="text/javascript">
        var chartDataTelurDitemukan = @php echo json_encode($chartDataTelurDitemukan); @endphp;
        var chartDataTelurMenetas =  @php echo json_encode($chartDataTelurMenetas); @endphp;
        var chartDataTukikDilepas = @php echo json_encode($chartDataTukikDilepas); @endphp;
        var chartDataPengunjung = @php echo json_encode($chartDataPengunjung); @endphp;
        var labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Chart for Telur Ditemukan
        new Chart(document.getElementById("chartTelurDitemukan"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataTelurDitemukan,
                    label: "Jumlah Telur Ditemukan",
                    backgroundColor: "green",
                    borderColor: "green",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Telur Ditemukan'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });

        // Chart for Telur Menetas
        new Chart(document.getElementById("chartTelurMenetas"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataTelurMenetas,
                    label: "Jumlah Telur Menetas",
                    backgroundColor: "#ffcc00",
                    borderColor: "#ffcc00",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Telur Menetas'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });

        // Chart for Tukik Dilepas
        new Chart(document.getElementById("chartTukikDilepas"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataTukikDilepas,
                    label: "Jumlah Tukik Dilepas",
                    backgroundColor: "#cc3399",
                    borderColor: "#cc3399",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Tukik Dilepas'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });

        // Chart for Pengunjung
        new Chart(document.getElementById("chartPengunjung"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: chartDataPengunjung,
                    label: "Jumlah Pengunjung",
                    backgroundColor: "#009999",
                    borderColor: "#009999",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah Pengunjung'
                },
                scales: {
                    y : {
                        beginAtZero: true,
                        max: 500
                    }
                }
            }
        });
    </script>
@endsection
