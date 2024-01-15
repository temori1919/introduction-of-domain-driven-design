<?php

namespace App\Applications\Circles;

use Exception;

class CircleCreateCommand
{

    public function __construct(
        private readonly string $userId,
        private readonly string $name,
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
