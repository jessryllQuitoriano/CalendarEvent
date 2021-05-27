<?php


namespace App\Services\Repository;

interface CalendarEventRepositoryInterface
{
    public function createOne(array $data);

    public function getByIds(array $ids);

    public function findById(int $id);
}
