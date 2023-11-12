<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_nilais', function (Blueprint $table) {
            $table->id();
            $table->integer('kriteria_id')->unique();
            $table->text('ket1')->nullable();
            $table->text('ket2')->nullable();
            $table->text('ket3')->nullable();
            $table->text('ket4')->nullable();
            $table->text('ket5')->nullable();

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
        Schema::dropIfExists('kriteria_nilais');
    }
}
