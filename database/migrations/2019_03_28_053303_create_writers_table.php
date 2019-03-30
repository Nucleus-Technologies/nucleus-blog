<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWritersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('writers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->text('biography')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('avatar')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('writers');
    }
}
