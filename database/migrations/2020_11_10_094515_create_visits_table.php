<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->string('date');
            $table->string('time');
            $table->integer('duration')->unsigned();;
            $table->decimal('cost', 5, 2);
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('patient_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
