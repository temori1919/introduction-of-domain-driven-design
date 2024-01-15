<?php

namespace App\Domeins\Circles;

use App\Domeins\Circles\CircleArgumentNullException;
use App\Domeins\Circles\CircleArgumentException;

class CircleId
{

    public function __construct(
        private readonly string $value,
    ) {
        if (is_null($value)) {
            throw new CircleArgumentNullException('CircleIdがnill');
        }

        if (!strlen($value)) {
            throw new CircleArgumentException('CircleIdが空');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
