<?php


namespace App\Services\Repository\DBQuery;


use App\Services\Repository\EventDateRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EventDateRepository implements EventDateRepositoryInterface
{
    public function getAll()
    {
        return DB::table('event_dates')
            ->select(['id', 'event_id', 'date'])
            ->orderBy('date', 'desc')
            ->get();
    }

    public function createMany(array $data)
    {
        return DB::table('event_dates')->insert($data);
    }

    public function getByEventId(int $eventId)
    {
        return DB::table('event_dates')
            ->select(['id', 'event_id', 'date'])
            ->where('event_id', $eventId)
            ->orderBy('date', 'desc')
            ->get();
    }
}
