<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_records', function (Blueprint $table) {
            $table->id();
            $table->date('periode');
            $table->string('kode');
            $table->string('name');
            $table->enum('type', ['benefit', 'cost']);
            $table->enum('optimum', ['min', 'max']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriteria_records');
    }
}
