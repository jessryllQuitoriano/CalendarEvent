<?php


namespace App\Services;


use Carbon\Carbon;

class PeriodDateChecker
{
    /*
     * check if the day of selected
     */
    public static function checkDaySelected($date, array $dayOfWeek)
    {
        return ($date->isSunday() && in_array(Carbon::SUNDAY, $dayOfWeek)
        || $date->isMonday() && in_array(Carbon::MONDAY, $dayOfWeek)
        || $date->isTuesday() && in_array(Carbon::TUESDAY, $dayOfWeek)
        || $date->isWednesday() && in_array(Carbon::WEDNESDAY, $dayOfWeek)
        || $date->isThursday() && in_array(Carbon::THURSDAY, $dayOfWeek)
        || $date->isFriday() && in_array(Carbon::FRIDAY, $dayOfWeek)
        || $date->isSaturday() && in_array(Carbon::SATURDAY, $dayOfWeek));
    }
}
