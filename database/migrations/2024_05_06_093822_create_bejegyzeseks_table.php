<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bejegyzesek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tevekenyseg_id');
            $table->string("osztlay_nev");
            $table->boolean("allapot");
            $table->timestamps();

            $table->foreign('tevekenyseg_id')->references('tevekenyseg_id')->on('tevekenyseg');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('bejegyzesek');
    }
};
