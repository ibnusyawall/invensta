<?php

use Illuminate\Database\Seeder;

class DetailPinjamnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detailPinjams = [
            [
                'id' => 1,
                'jumlah' => 20,
                'inventaris_id' => 1,
                'peminjaman_id' => 1
            ],
            [
                'id' => 2,
                'jumlah' => 42,
                'inventaris_id' => 2,
                'peminjaman_id' => 2
            ],
        ];

        foreach($detailPinjams as $q) {
            DB::table('detail_pinjams')->insert($q);
        }
    }
}
