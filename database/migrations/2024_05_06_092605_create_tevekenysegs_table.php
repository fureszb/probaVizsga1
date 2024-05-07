<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tevekenyseg', function (Blueprint $table) {
            $table->unsignedBigInteger('tevekenyseg_id')->primary();
            $table->string("tevekenyseg_nev");
            $table->integer("pontszam");
            $table->timestamps();
        });

        DB::table('tevekenyseg')->insert([
            [
                'tevekenyseg_id' => 1,
                'tevekenyseg_nev' => 'kerékpárral jöttem iskolába',
                'pontszam' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tevekenyseg_id' => 2,
                'tevekenyseg_nev' => 'Rollerrel jöttem iskolába ',
                'pontszam' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tevekenyseg_id' => 3,
                'tevekenyseg_nev' => '10 km-t gyalogoltam buszozás helyett ',
                'pontszam' => 22,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tevekenyseg_id' => 4,
                'tevekenyseg_nev' => 'ültettem fát ',
                'pontszam' => 22,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tevekenyseg');
    }
};
