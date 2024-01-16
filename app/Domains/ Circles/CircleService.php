<?php

namespace App\Domeins\Circles;

use App\Domeins\Circles\CircleRepositoryInterface;
use App\Domeins\Circles\Circle;

class CircleService
{

    public function __construct(
        private readonly CircleRepositoryInterface $circleRepository
    ) {
    }

    public function exists(Circle $circle): bool
    {
        $duplicated = $this->circleRepository->findName($circle->circleName);
        return  $duplicated !== null;
    }

    public function isOverThirty(Circle $circle): bool
    {
        $count = $this->circleRepository->count($circle->circleId);
        return $count >= 30;
    }
}
