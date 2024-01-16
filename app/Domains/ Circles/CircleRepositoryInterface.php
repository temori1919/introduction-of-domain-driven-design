<?php

namespace App\Domeins\Circles;

use App\Domeins\Circles\Circle;
use App\Domeins\Circles\CircleId;
use App\Domeins\Circles\CircleName;

interface CircleRepositoryInterface
{
    public function save(Circle $circle): void;
    public function findId(CircleId $circleId): Circle;
    public function findName(CircleName $circleName): Circle;
    public function count(CircleId $circleId): int;
}
