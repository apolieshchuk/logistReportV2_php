<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('surname', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('father', 100)->nullable();
            $table->unsignedBigInteger('post_id');
            $table->string('tel')->nullable();
            $table->string('license')->nullable();
            $table->timestamps();

            $table->unique(['surname', 'name', 'father', 'post_id']);

            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
