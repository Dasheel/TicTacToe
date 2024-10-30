<?php

namespace Tests\Feature\DataProvider;

/**
 * @internal
 */
trait GameMoveProvider
{
    public static function position()
    {
        return [
            ['position', 'foo'],
            ['position', null],
            ['position', ''],
            ['position', -1],
            ['position', 9],
            ['position', []],
            ['position', ['foo']],
        ];
    }

    public static function playerId()
    {
        return [
            ['player_id', 'foo'],
            ['player_id', null],
            ['player_id', ''],
            ['player_id', 0],
            ['player_id', 3],
            ['player_id', []],
            ['player_id', ['foo']],
        ];
    }
}
