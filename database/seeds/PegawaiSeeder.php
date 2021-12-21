<?php

use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pegawais = [
            [
                'id' => 1,
                'nama_pegawai' => 'Fajar Gunadi',
                'username' => 'fajar',
                'password' => bcrypt('fajar'),
                'alamat' => 'Jl. Banjarsari - Pangandaran, Dsn. Nagrak, Banjarsari, Ciamis.',
                'nip' => '123456789102345678',
//                'petugas_id' => 3
            ],
        ];

        foreach($pegawais as $q) {
            DB::table('pegawais')->insert($q);
        }
    }
}
