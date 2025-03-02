<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- ApexCharts CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.css">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Dashboard Mahasiswa</h2>

            <!-- Filter Form -->
            <form id="filterForm" class="row g-3">
                <div class="col-md-4">
                    <label for="prodi_id" class="form-label">Prodi:</label>
                    <select name="prodi_id" id="prodi_id" class="form-select">
                        <option value="">Semua Prodi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="nim" class="form-label">NIM:</label>
                    <input type="text" name="nim" id="nim" class="form-control" placeholder="Cari NIM">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" id="filterButton" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>

        <!-- Chart -->
        <div class="card mt-4 shadow-lg p-4">
            <h5 class="text-center">Statistik Mahasiswa</h5>
            <div id="chart" class="mx-auto" style="width: 100%; height: 500px;"></div>
        </div>

        <!-- Table -->
        <div class="card mt-4 shadow-lg p-4">
            <h5 class="text-center mb-3">Data Mahasiswa</h5>
            <div class="table-responsive">
                <table id="mahasiswaTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Status Lulus</th>
                            <th>IPK</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- ApexCharts JS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            var table = $('#mahasiswaTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.data') }}",
                    data: function(d) {
                        d.prodi_id = $('#prodi_id').val();
                        d.nim = $('#nim').val();
                    }
                },
                columns: [{
                        data: 'nim',
                        name: 'nim'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nama_prodi',
                        name: 'prodi.nama_prodi'
                    },
                    {
                        data: 'status_lulus',
                        name: 'status_lulus'
                    },
                    {
                        data: 'ipk',
                        name: 'ipk'
                    },
                ]
            });

            // Filter Button
            $('#filterButton').on('click', function() {
                table.ajax.reload();
            });
        });

        // Inisialisasi ApexCharts
        var options = {
            series: @json($chartData['data']),
            chart: {
                type: 'pie',
                height: 500
            },
            labels: @json($chartData['labels']),
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</body>

</html>
