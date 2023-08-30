<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            'nama' => 'ani',
            'nomor_induk' => '1000',
            'alamat'=>'bengkalis',
            'created_at' => date ('Y-m-d H:i:s')
        ]);

        DB::table('siswa')->insert([
            'nama' => 'jack',
            'nomor_induk' => '1001',
            'alamat'=>'dumai',
            'created_at' => date ('Y-m-d H:i:s')
        ]);

        DB::table('siswa')->insert([
            'nama' => 'obi',
            'nomor_induk' => '1002',
            'alamat'=>'siak',
            'created_at' => date ('Y-m-d H:i:s')
        ]);
    }
}
