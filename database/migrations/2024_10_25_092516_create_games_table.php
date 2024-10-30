<?php

use App\Enums\GameStatus;
use App\Enums\GameWinner;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(GameStatus::IN_PROGRESS->value);
            $table->json('grid');
            $table->unsignedTinyInteger('player_id')->default(1);
            $table->enum('winner', [
                GameWinner::PLAYER_1->value,
                GameWinner::PLAYER_2->value,
                GameWinner::DRAW->value,
            ])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
