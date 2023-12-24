<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('player_sessions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger("session_id");
            $table->string("player_name");
            $table->integer("player_shot1")->default(0);
            $table->integer("player_shot2")->default(0);
            $table->integer("player_shot3")->default(0);
            $table->integer("player_shot4")->default(0);
            $table->integer("player_shot5")->default(0);
            $table->integer("player_shot6")->default(0);
            $table->integer("player_shot7")->default(0);
            $table->integer("player_shot8")->default(0);
            $table->integer("player_shot9")->default(0);
            $table->integer("player_shot10")->default(0);
            $table->integer("player_total_score");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_sessions');
    }
};
