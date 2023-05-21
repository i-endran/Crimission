<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'Stolen paper',
            'mac' => 'secret',
            'priority' => 'simple',
            'privacy' => 'local',
            'post_type' => 'Complaint',
            'accused' => 'Kaviyarasan',
            'accused_details' => 'black, height, final cse, tiruppur guy',
            'locality' => 'Tiruppur',
            'status' => 'pending',
            'body' => 'Stolen papers from me',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('posts')->insert([
            'title' => 'Data plan',
            'mac' => 'secret',
            'priority' => 'moderate',
            'privacy' => 'public',
            'post_type' => 'Awareness',
            'accused' => 'Mobile operators',
            'accused_details' => 'All mobile operators in India',
            'locality' => 'India',
            'status' => 'pending',
            'body' => 'Before Jio, most of the mobile operators charged huge amount for 1 GB of data. After launch of Jio 4G people can access internet cheaper.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
