<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indiv_achiv_ball_scales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('indiv_achiv_ball_id');
            $table->unsignedBigInteger('scale_id');

            $table->foreign('indiv_achiv_ball_id', 'indiv_achiv_ball_id_fk')->on('scales')->references('id');
            $table->foreign('scale_id', 'scale_id_fk')->on('scales')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indiv_achiv_balls_scales');
    }
};
