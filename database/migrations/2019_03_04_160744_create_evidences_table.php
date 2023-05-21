<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 30);
            $table->string('mac');
            $table->integer('post_id')->index('post_id')->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->string('data');
            $table->enum('type', ['image', 'audio', 'video', 'text']);
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
        Schema::dropIfExists('evidences');
    }
}
