<?php

use App\Enums\GameWinner;
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
            $table->unsignedTinyInteger('player_id')->default(1);
            $table->enum('winner', [
                GameWinner::PLAYER_1->value,
                GameWinner::PLAYER_2->value,
                GameWinner::DRAW->value
            ])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
