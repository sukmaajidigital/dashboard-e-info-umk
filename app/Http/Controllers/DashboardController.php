<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data prodi untuk filter
        $prodis = Prodi::all();

        // Ambil daftar tabel mahasiswa yang ada di database
        $tables = $this->getMahasiswaTables();

        // Hitung total mahasiswa per prodi untuk chart
        $chartData = $this->getChartData($tables);

        return view('dashboard.index', compact('prodis', 'chartData'));
    }

    public function getData(Request $request)
    {
        // Ambil parameter filter
        $prodiId = $request->input('prodi_id');
        $nim = $request->input('nim');

        // Ambil daftar tabel mahasiswa yang ada di database
        $tables = $this->getMahasiswaTables();

        // Jika prodi_id tidak disediakan, ambil data dari semua tabel mahasiswa
        if (!$prodiId) {
            $results = [];

            // Loop melalui setiap tabel dan gabungkan hasilnya
            foreach ($tables as $kodeProdi => $tableName) {
                $query = DB::table($tableName)
                    ->join('prodi', $tableName . '.prodi_id', '=', 'prodi.kode_prodi')
                    ->select(
                        $tableName . '.nim',
                        $tableName . '.nama',
                        $tableName . '.status_lulus',
                        $tableName . '.ipk',
                        'prodi.nama_prodi'
                    );

                // Filter berdasarkan NIM
                if ($nim) {
                    $query->where($tableName . '.nim', 'like', '%' . $nim . '%');
                }

                // Tambahkan hasil query ke array
                $results = array_merge($results, $query->get()->toArray());
            }

            // Kembalikan data dalam format DataTables
            return DataTables::of($results)->toJson();
        }

        // Jika prodi_id disediakan, ambil data dari tabel yang sesuai
        $tableName = $prodiId . '_mahasiswa';

        // Pastikan tabel tersebut ada dalam daftar tabel
        if (!in_array($tableName, $tables)) {
            return DataTables::of([])->toJson(); // Kembalikan data kosong jika tabel tidak ditemukan
        }

        // Query dasar
        $query = DB::table($tableName)
            ->join('prodi', $tableName . '.prodi_id', '=', 'prodi.kode_prodi')
            ->select(
                $tableName . '.nim',
                $tableName . '.nama',
                $tableName . '.status_lulus',
                $tableName . '.ipk',
                'prodi.nama_prodi'
            );

        // Filter berdasarkan NIM
        if ($nim) {
            $query->where($tableName . '.nim', 'like', '%' . $nim . '%');
        }

        // Kembalikan data dalam format DataTables
        return DataTables::of($query)->toJson();
    }

    /**
     * Ambil daftar tabel mahasiswa dari database.
     *
     * @return array
     */
    private function getMahasiswaTables()
    {
        // Ambil nama database
        $databaseName = DB::getDatabaseName();
        $propertyName = 'Tables_in_' . $databaseName; // Contoh: Tables_in_my_database

        // Ambil semua tabel di database
        $tables = DB::select('SHOW TABLES');

        // Filter tabel yang memiliki pola nama "{kode_prodi}_mahasiswa"
        $mahasiswaTables = [];
        foreach ($tables as $table) {
            $tableName = $table->$propertyName; // Akses properti dinamis
            if (preg_match('/^\d+_mahasiswa$/', $tableName)) {
                $kodeProdi = explode('_', $tableName)[0]; // Ambil kode prodi dari nama tabel
                $mahasiswaTables[$kodeProdi] = $tableName;
            }
        }

        return $mahasiswaTables;
    }

    /**
     * Ambil data untuk chart (total mahasiswa per prodi).
     *
     * @param array $tables
     * @return array
     */
    private function getChartData($tables)
    {
        $labels = [];
        $data = [];

        foreach ($tables as $kodeProdi => $tableName) {
            // Ambil nama prodi
            $prodi = Prodi::where('kode_prodi', $kodeProdi)->first();
            $prodiName = $prodi ? $prodi->nama_prodi : 'Prodi ' . $kodeProdi;

            // Hitung total mahasiswa
            $totalMahasiswa = DB::table($tableName)->count();

            // Tambahkan ke data chart
            $labels[] = $prodiName . ' (' . $kodeProdi . ')';
            $data[] = $totalMahasiswa;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
