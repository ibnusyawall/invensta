<?php

use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruangs = [
            [
                'id' => 1,
                'nama_ruang' => 'Gudang Satu',
                'kode_ruang' => 'G_001',
                'keterangan' => 'Ruang Gudang Satu'
            ],
            [
                'id' => 2,
                'nama_ruang' => 'Gudang Dua',
                'kode_ruang' => 'G_002',
                'keterangan' => 'Ruang Gudang Dua'
            ],
            [
                'id' => 3,
                'nama_ruang' => 'Gudang Tiga',
                'kode_ruang' => 'G_003',
                'keterangan' => 'Ruang Gudang Tiga'
            ],
        ];

        foreach($ruangs as $q) {
            DB::table('ruangs')->insert($q);
        }
    }
}
