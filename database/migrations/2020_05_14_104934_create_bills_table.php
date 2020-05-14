<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('num',50)->nullable();
            $table->date('bills_date')->nullable();
            $table->integer('sum');
            $table->date('originals_date')->nullable();
            $table->foreignId('carrier_id')->constrained();
            $table->date('payed_date')->nullable();
            $table->string('notes')->nullable();
            $table->date('approval_date')->nullable();
            $table->unsignedBigInteger('payer_id');
            $table->foreignId('route_id')->constrained();
            $table->timestamps();

            $table->foreign('payer_id')->on('firms')->references('id');

            $table->unique(['bills_date','num','payer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
