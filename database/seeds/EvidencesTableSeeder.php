<?php

use Illuminate\Database\Seeder;

class EvidencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evidences')->insert([
            'title' => 'evidence 1',
            'mac' => 'secret',
            'post_id' => 1,
            'data' => '1.jpg',
            'type' => 'image',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
