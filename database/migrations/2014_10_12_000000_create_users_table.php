<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25);
            $table->string('email', 30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 15)->unique();
            $table->date('dob');
            $table->enum('sex', ['male', 'female', 'others']);
            $table->enum('acc_type', ['normal', 'validator']);
            $table->enum('proof_type', ['adhaar', 'voter_id', 'driving_licsence']);
            $table->string('proof_id', 30);
            $table->text('address')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        \DB::statement('alter table users add avatar mediumblob');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
