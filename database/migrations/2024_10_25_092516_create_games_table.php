<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('in_progress');
            $table->json('grid');
            $table->enum('turn', ['X', 'O'])->default('X');
            $table->enum('winner', ['X', 'O', 'draw'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
