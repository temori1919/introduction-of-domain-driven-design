<?php

namespace App\Domeins\Circles;

use App\Domeins\Circles\CircleName;
use App\Domeins\Circles\Circle;

interface CircleFactoryInterface
{
    public function create(CircleName $circleName, User $owner): Circle;
}
