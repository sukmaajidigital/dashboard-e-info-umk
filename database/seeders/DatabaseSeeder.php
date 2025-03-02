<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MasterSeeder::class,
            Seeder52::class,
            Seeder53::class,
            Seeder01::class,
            Seeder02::class,
            Seeder03::class,
            Seeder04::class,
            Seeder11::class,
            Seeder12::class,
            Seeder20::class,
            Seeder31::class,
            Seeder32::class,
            Seeder33::class,
            Seeder34::class,
            Seeder35::class,
            Seeder41::class,
            Seeder51::class,
            Seeder54::class,
            Seeder57::class,
            Seeder60::class,
        ]);
    }
}
