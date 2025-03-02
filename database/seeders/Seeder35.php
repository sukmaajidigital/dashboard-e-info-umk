<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Seeder35 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed 35_mahasiswa
        $mahasiswaData = json_decode(File::get(database_path('json/35/mahasiswa.json')), true);
        foreach ($mahasiswaData as $mahasiswa) {
            DB::table('35_mahasiswa')->insert([
                'nim' => $mahasiswa['nim'],
                'nama' => $mahasiswa['nama'],
                'prodi_id' => $mahasiswa['kode_prodi'],
                'status_lulus' => $mahasiswa['status_lulus'],
                'no_ijasah' => $mahasiswa['no_ijasah'],
                'no_ijasah_nasional' => $mahasiswa['no_ijasah_nasional'],
                'ipk' => $mahasiswa['ipk'],
                'smt_lulus' => $mahasiswa['smt_lulus'],
                'smt_masuk' => $mahasiswa['smt_masuk'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Data mahasiswa berhasil diinput! (NIM: ' . $mahasiswa['nim'] . ')');
        }

        // Seed 35_riwayat_kawe
        $riwayatKaweData = json_decode(File::get(database_path('json/35/riwayat_kawe.json')), true);
        foreach ($riwayatKaweData as $riwayat) {
            DB::table('35_riwayat_kawe')->insert([
                'nim_id' => $riwayat['nim'],
                'kawe_id' => $riwayat['kode_kawe'],
                'nilai' => $riwayat['nilai'],
                'tahun_akademik' => $riwayat['tahunakademik'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Data riwayat kawe berhasil diinput! (NIM: ' . $riwayat['nim'] . ')');
        }

        // Seed 35_riwayat_matakuliah
        $riwayatMatakuliahData = json_decode(File::get(database_path('json/35/riwayat_matakuliah.json')), true);
        foreach ($riwayatMatakuliahData as $riwayat) {
            // Jika kode_matakuliah kosong, skip entri ini
            if (empty($riwayat['kode_matakuliah'])) {
                $this->command->warn("Kode Matakuliah kosong untuk NIM {$riwayat['nim']}. Data ini akan dilewati.");
                continue;
            }

            // Cek apakah kode_matakuliah ada di tabel matakuliah
            $matakuliahExists = DB::table('matakuliah')
                ->where('kode_matakuliah', $riwayat['kode_matakuliah'])
                ->exists();

            if ($matakuliahExists) {
                DB::table('35_riwayat_matakuliah')->insert([
                    'nim_id' => $riwayat['nim'],
                    'matakuliah_id' => $riwayat['kode_matakuliah'],
                    'semester' => $riwayat['semester'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Tampilkan pesan warning jika kode_matakuliah tidak ditemukan
                $this->command->warn("Kode Matakuliah {$riwayat['kode_matakuliah']} tidak ditemukan di tabel matakuliah.");
            }
        }
    }
}
