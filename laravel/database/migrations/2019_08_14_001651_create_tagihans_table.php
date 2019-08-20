<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trxId')->nullable();
            $table->string('mandateId')->nullable();
            $table->string('pgpToken')->nullable();
            $table->string('refNum')->nullable();
            $table->string('src')->nullable();
            $table->string('nomor');
            $table->string('nama');
            $table->string('items');
            $table->string('tagihan');
            $table->string('status');
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
        Schema::dropIfExists('tagihans');
    }
}
