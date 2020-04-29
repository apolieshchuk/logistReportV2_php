<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrier_id');
            $table->string('mark')->nullable();
            $table->string('auto_num')->nullable();
            $table->string('trail_num')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->foreign('carrier_id')->references('id')->on('carriers');
            $table->foreign('driver_id')->references('id')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autos');
    }
}
