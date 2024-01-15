<?php

namespace App\Domeins\Circles;

class Circle
{

    public function __construct(
        private readonly CircleId $circleId,
        private readonly CircleName $circleName,
        private readonly User $owner, # 実際に作ってない
        private readonly Members $members, # ファーストクラスコレクション的なクラス想定
    ) {
    }

    public function __get($name)
    {
        if (!property_exists($this,  $name)) {
            throw new CircleArgumentException('そんなプロパティないよ');
        }

        return $this->$name;
    }
}
