<?php

namespace App\Applications\Circles;

use App\Domeins\Circles\Circle;
use App\Domeins\Circles\CircleFactoryInterface;
use App\Domeins\Circles\CircleName;
use App\Domeins\Circles\circleId;
use App\Domeins\Circles\CircleRepositoryInterface;
use App\Domeins\Circles\CircleService;
use Exception;
use Illuminate\Support\Facades\DB;

class CircleApplicationService
{
    public function __construct(
        private readonly CircleFactoryInterface $circleFactory,
        private readonly CircleRepositoryInterface $circleRepository,
        private readonly CircleService $circleService,
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function create(CircleCreateCommand $command)
    {
        DB::beginTransaction();
        try {
            $ownerId = new UserId($command->userId);
            $owner = $this->userRepository->find($ownerId);

            if ($owner === null) {
                throw new Exception('オーナーなし');
            }

            $name = new CircleName($command->name);
            $circle = $this->circleFactory->create($name, $owner);

            if ($this->circleService->exists($circle)) {
                throw new Exception('すでにサークルが存在');
            }

            $this->circleRepository->save($circle);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function join(CircleJoinCommand $command)
    {
        DB::beginTransaction();
        try {
            $memberId = new UserId($command->userId);
            $member = $this->userRepository->find($ownerId);

            if ($member === null) {
                throw new Exception('メンバーなし');
            }

            $id = new CircleId($command->circleId);
            $circle = $this->circleRepository->findId($id);

            if ($circle === null) {
                throw new Exception('サークルなし');
            }

            if ($this->circleService->isOverThirty($circle)) {
                throw new Exception('30名以上います');
            }

            // Membersクラスがaddメソッドでメンバー追加できる想定
            $circle->members->add($member);
            $this->circleRepository->save($circle);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
