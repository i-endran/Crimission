<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasefileEvidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casefile_evidences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 30);
            $table->integer('casefile_id')->index('casefile_id')->foreign('casefile_id')->references('id')->on('casefiles')->onDelete('cascade');
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
        Schema::dropIfExists('casefile_evidences');
    }
}
