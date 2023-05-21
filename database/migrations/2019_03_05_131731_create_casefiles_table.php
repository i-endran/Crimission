<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasefilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casefiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 30);
            $table->integer('post_id')->index('post_id')->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->integer('user_id')->index('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['initiating', 'filed', 'hearings', 'justified', 'rejected']);
            $table->string('file_url')->nullable();
            $table->string('case_id')->nullable();
            $table->string('court_name')->nullable();
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
        Schema::dropIfExists('casefiles');
    }
}
