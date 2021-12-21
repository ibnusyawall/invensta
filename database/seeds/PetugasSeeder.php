<?php

use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petugas = [
            [
                'id' => 1,
                'nama_petugas' => 'Ibnu Syawal',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'level_id' => 1
            ],
            [
                'id' => 2,
                'nama_petugas' => 'Ajid Solehudin',
                'username' => 'operator',
                'password' => bcrypt('operator'),
                'level_id' => 2
            ],
            [
                'id' => 3,
                'nama_petugas' => 'Fahri Gunadi',
                'username' => 'peminjam',
                'password' => bcrypt('peminjam'),
                'level_id' => 3
            ],
        ];

        foreach($petugas as $q) {
            DB::table('petugas')->insert($q);
        }
    }
}
