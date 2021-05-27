<?php


namespace App\Services\Repository;


interface EventDateRepositoryInterface
{
    public function getByMonth(int $month);

    public function createMany(array $data);

    public function getByEventId(int $eventId);
}
