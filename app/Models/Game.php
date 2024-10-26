<?php

namespace App\Models;

use App\Enums\GameTurn;
use App\Enums\GameStatus;
use App\Enums\GameWinner;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int             $id
 * @property string          $status
 * @property array           $grid
 * @property GameTurn        $turn
 * @property GameWinner|null $winner
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereGrid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereTurn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereWinner($value)
 * @method static \Database\Factories\GameFactory                    factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'grid', 'turn', 'winner'];

    protected $casts = [
        'grid' => 'array',
        'status' => GameStatus::class,
        'turn' => GameTurn::class,
        'winner' => GameWinner::class,
    ];
}
