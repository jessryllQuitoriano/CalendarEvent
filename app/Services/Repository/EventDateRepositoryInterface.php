<?php


namespace App\Services\Repository;


interface EventDateRepositoryInterface
{
    public function getAll();

    public function createMany(array $data);

    public function getByEventId(int $eventId);
}
