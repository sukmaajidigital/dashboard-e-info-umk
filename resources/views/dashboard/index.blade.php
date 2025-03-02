<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- ApexCharts CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.css">
    <style>
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class=" flex flex-col">
        <div class="p-4">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-3xl font-bold text-center text-blue-600">Dashboard Data Universitas Muria Kudus</h2>
                <h6 class="text-center text-green-500 italic">Data Angkatan (2002-2024) Last Update Data Februari 2025</h6>


            </div>





            <!-- Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h5 class="text-xl font-semibold text-center">Filter Berdasarkan Angkatan</h5>
                <select id="angkatanFilter" class="mt-4 p-2 border rounded-lg">
                    <option value="">Pilih Angkatan</option>
                    @foreach ($angkatans as $angkatan)
                        <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                    @endforeach
                </select>
                <h5 class="text-xl font-semibold text-center">Statistik Mahasiswa</h5>
                <div id="chart" class="mt-4" style="width: 100%; height: 400px;"></div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <!-- Filter Form -->
                <form id="filterForm" class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700">Prodi:</label>
                        <select name="prodi_id" id="prodi_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="">Semua Prodi</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM:</label>
                        <input type="text" name="nim" id="nim" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" placeholder="Cari NIM">
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama:</label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" placeholder="Cari Nama">
                    </div>
                    <div class="flex items-end">
                        <button type="button" id="filterButton" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Filter</button>
                    </div>
                </form>
                <h5 class="text-xl font-semibold text-center mb-4">Data Mahasiswa</h5>
                <div class="overflow-x-auto">
                    <table id="mahasiswaTable" class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/5 px-4 py-2">NIM</th>
                                <th class="w-1/5 px-4 py-2">Nama</th>
                                <th class="w-1/5 px-4 py-2">Prodi</th>
                                <th class="w-1/5 px-4 py-2">Status Lulus</th>
                                <th class="w-1/5 px-4 py-2">IPK</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>




            <div class="row">
                <!-- Tab Content -->
                <div class=" col">
                    <!-- Fakultas Tab -->
                    <div id="fakultas">
                        <div class="overflow-x-auto">
                            <table id="fakultasTable" class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-1/5 px-4 py-2">Kode Fakultas</th>
                                        <th class="w-1/5 px-4 py-2">Nama Fakultas</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Prodi Tab -->
                <div class="col">
                    <div id="prodi">
                        <div class="overflow-x-auto">
                            <table id="prodiTable" class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-1/5 px-4 py-2">Kode Prodi</th>
                                        <th class="w-1/5 px-4 py-2">Nama Prodi</th>
                                        <th class="w-1/5 px-4 py-2">Fakultas</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Matakuliah Tab -->
                <div class=" col">
                    <div id="matakuliah">
                        <div class="overflow-x-auto">
                            <table id="matakuliahTable" class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-1/5 px-4 py-2">Kode Matakuliah</th>
                                        <th class="w-1/5 px-4 py-2">Nama Matakuliah</th>
                                        <th class="w-1/5 px-4 py-2">SKS</th>
                                        <th class="w-1/5 px-4 py-2">Prodi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
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
        document.getElementById('angkatanFilter').addEventListener('change', function() {
            var selectedAngkatan = this.value;

            // Kirim request AJAX untuk mendapatkan data berdasarkan angkatan
            fetch(`/dashboard/filter?angkatan=${selectedAngkatan}`)
                .then(response => response.json())
                .then(data => {
                    // Perbarui chart dengan data baru
                    chart.updateOptions({
                        series: data.data,
                        labels: data.labels
                    });
                });
        });
        $(document).ready(function() {

            // Fakultas Table
            $('#fakultasTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.fakultas') }}",
                columns: [{
                        data: 'kode_fakultas',
                        name: 'kode_fakultas'
                    },
                    {
                        data: 'nama_fakultas',
                        name: 'nama_fakultas'
                    },
                ]
            });

            // Prodi Table
            $('#prodiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.prodi') }}",
                columns: [{
                        data: 'kode_prodi',
                        name: 'kode_prodi'
                    },
                    {
                        data: 'nama_prodi',
                        name: 'nama_prodi'
                    },
                    {
                        data: 'nama_fakultas',
                        name: 'fakultas.nama_fakultas'
                    },
                ]
            });

            // Matakuliah Table
            $('#matakuliahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.matakuliah') }}",
                columns: [{
                        data: 'kode_matakuliah',
                        name: 'kode_matakuliah'
                    },
                    {
                        data: 'matakuliah',
                        name: 'matakuliah'
                    },
                    {
                        data: 'sks',
                        name: 'sks'
                    },
                    {
                        data: 'nama_prodi',
                        name: 'prodi.nama_prodi'
                    },
                ]
            });
        });
    </script>
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
                        d.nama = $('#nama').val();
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
                height: 400
            },
            labels: @json($chartData['labels']),
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</body>

</html>
