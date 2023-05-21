<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 30);
            $table->string('mac');
            $table->enum('priority', ['simple', 'moderate', 'high', 'extreme']);
            $table->enum('privacy', ['private', 'local', 'public']);
            $table->string('post_type', 25);
            $table->string('accused', 30);
            $table->string('accused_details');
            $table->string('locality', 20);
            $table->enum('status', ['pending', 'validated', 'pushed', 'completed', 'rejected']);
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
