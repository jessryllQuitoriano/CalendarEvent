<?php


namespace App\Services\Repository\DBQuery;


use App\Services\Repository\CalendarEventRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CalendarEventRepository implements CalendarEventRepositoryInterface
{

    public function createOne(array $data)
    {
        return DB::table('calendar_events')
            ->insertGetId($data);
    }

    public function getByIds(array $ids)
    {
        return DB::table('calendar_events')
            ->whereIn('id', $ids)
            ->get();
    }

    public function findById(int $id)
    {
        return DB::table('calendar_events')
            ->where('id', $id)
            ->first();
    }
}
