<?php

use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        $inventaris = [
            [
                'id' => 1,
                'nama' => 'Inventaris Satu',
                'kondisi' => 'Baik',
                'keterangan' => 'contoh inventaris peminjaman barang 001',
                'jumlah' => 20,
                'tanggal_register' => $date,
                'kode_inventaris' => 'INVEN_001',
                'ruang_id' => 1,
                'jenis_id' => 2,
                'petugas_id' => 3
            ],
            [
                'id' => 2,
                'nama' => 'Inventaris Dua',
                'kondisi' => 'Baik',
                'keterangan' => 'contoh inventaris peminjaman barang 002',
                'jumlah' => 15,
                'tanggal_register' => $date,
                'kode_inventaris' => 'INVEN_002',
                'ruang_id' => 2,
                'jenis_id' => 1,
                'petugas_id' => 2
            ],
        ];

        foreach($inventaris as $q) {
            DB::table('inventaris')->insert($q);
        }
    }
}
