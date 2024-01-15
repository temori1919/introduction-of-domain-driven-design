<?php

namespace App\Applications\Circles;

use Exception;

class CircleJoinCommand
{

    public function __construct(
        private readonly string $userId,
        private readonly string $circleId,
    ) {
    }

    public function __get($name)
    {
        if (!property_exists($this,  $name)) {
            throw new Exception('そんなプロパティないよ');
        }

        return $this->$name;
    }
}
