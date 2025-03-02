<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MasterSeeder extends Seeder
{
    public function run()
    {
        // Seed Fakultas
        $fakultasData = json_decode(File::get(database_path('json/fakultas.json')), true);
        foreach ($fakultasData as $fakultas) {
            DB::table('fakultas')->insert([
                'kode_fakultas' => $fakultas['kode_fakultas'],
                'nama_fakultas' => $fakultas['nama_fakultas'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Data fakultas berhasil diinput! (Kode Fakultas: ' . $fakultas['kode_fakultas'] . ')');
        }

        // Seed Kawe
        $kaweData = json_decode(File::get(database_path('json/kawe.json')), true);
        foreach ($kaweData as $kawe) {
            DB::table('kawe')->insert([
                'kode_kawe' => $kawe['kode_kawe'],
                'nama_kawe' => $kawe['nama_kawe'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Data kawe berhasil diinput! (Kode kawe: ' . $kawe['kode_kawe'] . ')');
        }

        // Seed Prodi
        $prodiData = json_decode(File::get(database_path('json/prodi.json')), true);
        foreach ($prodiData as $prodi) {
            DB::table('prodi')->insert([
                'kode_prodi' => $prodi['kode_prodi'],
                'nama_prodi' => $prodi['nama_prodi'],
                'fakultas_id' => $prodi['fakultas_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Data prodi berhasil diinput! (Kode prodi: ' . $prodi['kode_prodi'] . ')');
        }

        // Seed Program Keterampilan Kawe
        $programKaweData = json_decode(File::get(database_path('json/program_keterampilan_kawe.json')), true);
        foreach ($programKaweData as $program) {
            DB::table('program_keterampilan_kawe')->insert([
                'kode_program' => $program['kode_program'],
                'nama_program' => $program['nama_program'],
                'kawe_id' => $program['kawe_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Data Program kawe berhasil diinput! (Kode kawe: ' . $program['kode_program'] . ')');
        }

        // Seed Matakuliah
        $matakuliahData = json_decode(File::get(database_path('json/matakuliah.json')), true);
        foreach ($matakuliahData as $matakuliah) {
            DB::table('matakuliah')->insert([
                'kode_matakuliah' => $matakuliah['kode_matakuliah'],
                'matakuliah' => $matakuliah['matakuliah'],
                'sks' => $matakuliah['sks'],
                'prodi_id' => $matakuliah['kode_prodi'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Data matakuliah berhasil diinput! (Kode matakuliah: ' . $matakuliah['kode_matakuliah'] . ')');
        }
        $this->command->info('Semua data berhasil diinput!');
    }
}
