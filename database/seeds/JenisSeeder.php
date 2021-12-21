<?php

use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis = [
            [
                'id' => 1,
                'nama_jenis' => 'Jenis Konsumtif',
                'kode_jenis' => 'J_001',
                'keterangan' => 'Jenis Barang Konsumtif'
            ],
            [
                'id' => 2,
                'nama_jenis' => 'Jenis Alat Tulis',
                'kode_jenis' => 'J_002',
                'keterangan' => 'Jenis Barang Alat Tulis'
            ],
            [
                'id' => 3,
                'nama_jenis' => 'Jenis Perangkat Keras',
                'kode_jenis' => 'J_003',
                'keterangan' => 'Jenis Barang Perangkat Keras'
            ],
        ];

        foreach($jenis as $q) {
            DB::table('jenis')->insert($q);
        }
    }
}
