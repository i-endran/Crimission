<?php

use Illuminate\Database\Seeder;

class CasefileEvidencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('casefile_evidences')->insert([
            'title' => 'casefile evidence 1',
            'casefile_id' => 1,
            'data' => '1.jpg',
            'type' => 'image',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
