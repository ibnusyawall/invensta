<?php

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                'id' => 1,
                'nama_level' => 'Administrator',
            ],
            [
                'id' => 2,
                'nama_level' => 'Operator',
            ],
            [
                'id' => 3,
                'nama_level' => 'Peminjam',
            ],
        ];

        foreach($levels as $q) {
            DB::table('levels')->insert($q);
        }
    }
}
