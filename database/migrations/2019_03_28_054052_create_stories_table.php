<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('writer');
            $table->string('slug')->nullable()->unique();
            $table->string('category')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('hero');
            $table->longText('content');
            $table->integer('likes')->nullable();
            $table->timestamps();
            $table->dateTime('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
