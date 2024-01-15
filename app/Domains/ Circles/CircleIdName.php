<?php

namespace App\Domeins\Circles;

use App\Domeins\Circles\CircleArgumentNullException;
use App\Domeins\Circles\CircleArgumentException;

class CircleName
{

    public function __construct(
        private readonly string $value,
    ) {
        if (is_null($value)) {
            throw new CircleArgumentNullException('CircleNameがnill');
        }

        if (mb_strlen($value) < 3) {
            throw new CircleArgumentException('CircleNameが3文字未満');
        }

        if (mb_strlen($value) > 20) {
            throw new CircleArgumentException('CircleNameが20文字を超えてる');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
