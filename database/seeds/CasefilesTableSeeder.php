<?php

use Illuminate\Database\Seeder;

class CasefilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('casefiles')->insert([
            'title' => 'Stolen paper',
            'post_id' => 1,
            'user_id' => 1,
            'status' => 'initiating',
            'body' => 'Nothing is there to say',
            'file_url' => 'kdjhfkajhfkjh',
            'case_id' => 'sdasdad',
            'court_name' => 'Madras High Court',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
