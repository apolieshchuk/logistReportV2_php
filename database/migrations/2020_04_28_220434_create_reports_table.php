<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('carrier_id');
            $table->string('auto_num', 50);
            $table->string('trail_num', 50)->nullable();

            $table->unsignedBigInteger('driver_id');

            $table->unsignedInteger('f2');
            $table->unsignedInteger('f1');
            $table->boolean('tr')->default(0);
            $table->string('notes')->nullable();
            $table->timestamps();

            // unique
            $table->unique(['date', 'manager_id', 'cargo_id', 'route_id', 'carrier_id',
                'auto_num', 'trail_num', 'driver_id'],'uniq_report');

            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('manager_id')->references('id')->on('contacts');
            $table->foreign('driver_id')->references('id')->on('contacts');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('carrier_id')->references('id')->on('carriers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
