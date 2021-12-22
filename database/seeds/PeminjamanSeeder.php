<?php

use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peminjamen = [
            [
                'id' => 1,
                'tanggal_pinjam' => '2021-12-01 09:20:42',
                'tanggal_kembali' => '2021-12-02 09:20:42',
                'status_peminjaman' => 'waitlist',
                'pegawai_id' => 1
            ],
            [
                'id' => 2,
                'tanggal_pinjam' => '2021-12-02 09:20:42',
                'tanggal_kembali' => '2021-12-04 09:20:42',
                'status_peminjaman' => 'pinjam',
                'pegawai_id' => 1
            ],
        ];

        foreach($peminjamen as $q) {
            DB::table('peminjamen')->insert($q);
        }
    }
}
