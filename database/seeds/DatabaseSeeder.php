<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $dbseed = [
            LevelSeeder::class,
            PetugasSeeder::class,
            JenisSeeder::class,
            RuangSeeder::class,
            InventarisSeeder::class,
            PegawaiSeeder::class,
            PeminjamanSeeder::class,
            DetailPinjamnSeeder::class
        ];

        $this->call($dbseed);
    }
}
