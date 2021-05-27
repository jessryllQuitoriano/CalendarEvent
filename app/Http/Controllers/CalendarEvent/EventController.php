<?php

namespace App\Http\Controllers\CalendarEvent;

use App\Http\Controllers\Controller;
use App\Services\PeriodDateChecker;
use App\Services\Repository\CalendarEventRepositoryInterface;
use App\Services\Repository\EventDateRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @var EventDateRepositoryInterface
     */
    private $eventDateRepository;
    /**
     * @var CalendarEventRepositoryInterface
     */
    private $calendarEventRepository;

    public function __construct(EventDateRepositoryInterface $eventDateRepository, CalendarEventRepositoryInterface $calendarEventRepository)
    {
        $this->eventDateRepository = $eventDateRepository;
        $this->calendarEventRepository = $calendarEventRepository;
    }

    public function findAll(Request $request)
    {
        $dates = $this->eventDateRepository->getAll();
        $events = $this->calendarEventRepository->getByIds($dates->pluck('event_id')->toArray());

        $dateItems = $dates->map(function ($eventDate) use ($events) {
            $event = $events->where('id', $eventDate->event_id)->first();
            return [
                'id' => $eventDate->id,
                'date' => $eventDate->date,
                'event_id' => $eventDate->event_id,
                'title' => $event->event_name,
            ];
        });

        return response()->json($dateItems);
    }

    public function create(Request $request)
    {
        // day_of_week array that contain 0 to 6
        $this->validate($request, [
            'event_name' => "required",
            'start_from' => "required|date",
            'end_from' => "required|date",
            'day_of_week' => "required|array",
        ]);

        $eventId = $this->calendarEventRepository->createOne([
            'event_name' => $request['event_name'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $period = CarbonPeriod::between($request['start_from'], $request['end_from']);
        $dateItems = [];
        foreach ($period as $date) {
            if (PeriodDateChecker::checkDaySelected($date, $request['day_of_week'])) {
                array_push($dateItems, [
                    'event_id' => $eventId,
                    'date' => $date->toDateString()
                ]);
            }
        }

        $this->eventDateRepository->createMany($dateItems);
        $eventDateItems = $this->eventDateRepository->getByEventId($eventId)
            ->map(function ($eventDate) use ($request) {
                return [
                    'id' => $eventDate->id,
                    'date' => $eventDate->date,
                    'event_id' => $eventDate->event_id,
                    'title' => $request['event_name'],
                ];
            });

        return response()->json($eventDateItems);
    }
}
