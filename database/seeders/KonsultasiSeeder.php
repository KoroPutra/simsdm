<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KonsultasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $konselorIds = DB::table('users')->where('role', 2)->pluck('id')->toArray();
        $userIds = DB::table('users')->where('role', 3)->pluck('id')->toArray();

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'user_id' => $userIds[array_rand($userIds)],
                'konseler_id' => $konselorIds[array_rand($konselorIds)],
                'email' => Str::random(10) . '@example.com',
                'no_telpon' => '08123456789' . rand(0, 9),
                'judul' => 'Judul Konsultasi ' . $i,
                'pesan' => 'Pesan konsultasi ' . $i,
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('konsultasi')->insert($data);
    }
}
