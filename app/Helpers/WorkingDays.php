<?php


namespace App\Helpers;

use Carbon\Traits\Creator;
use DateTime;
use DateInterval;
use Carbon\Carbon;
use function Symfony\Component\String\b;

class WorkingDays
{
    public static function isHoliday($dateInput)
    {
        $currentYear = date('Y');

        $holidays = [
            $currentYear.'-01-01', $currentYear.'-04-07', $currentYear.'-04-21',
            $currentYear.'-05-01', $currentYear.'-09-07', $currentYear.'-10-12',
            $currentYear.'-11-02', $currentYear.'-11-15', $currentYear.'-12-25'];

        $dateInput = date('Y-m-d', strtotime($dateInput));

        if(in_array($dateInput, $holidays)){
            return true;
        }

        return false;
    }

    public static function hasFees($dateInput)
    {
        $pay = Carbon::parse($dateInput);
        $today = Carbon::now()->startOfDay();
//        $today = Carbon::parse('2023-11-17T00:00:00');

        if($today <= $pay)//Tá vencido?
        {
            return false;
        }
        else
        {
            $isHoliday = self::isHoliday($dateInput);

            if($isHoliday)//Vencimento é feriado?
            {
                if($pay->isWeekend()) //É final de semana?
                {
                    if($today >= $pay->next(Carbon::THURSDAY))
                    {
                        return true;
                    }
                }
                elseif($today > $pay->addDay())
                {
                    return true;
                }
            }

            if($pay->isWeekend()) //É final de semana?
            {
                if($today >= $pay->next(Carbon::THURSDAY))
                {
                    return true;
                }
                elseif($today > $pay->addDay())
                {
                    return true;
                }
            }

        }

        return false;
    }

}
