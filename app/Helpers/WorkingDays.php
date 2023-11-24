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
            $currentYear.'-05-01', $currentYear.'-09-07', $currentYear.'-09-15', $currentYear.'-10-12',
            $currentYear.'-11-02', $currentYear.'-11-15', $currentYear.'-12-25'];

        $dateInput = date('Y-m-d', strtotime($dateInput));

        if(in_array($dateInput, $holidays)){
            return true;
        }

        return false;
    }

    public static function hasFees($dueDate)
    {
        $pay = Carbon::parse($dueDate);
        $today = Carbon::now()->startOfDay();
//        $today = Carbon::parse('2023-09-14T00:00:00');
        $isHoliday = self::isHoliday($dueDate);

//        if($today > $pay)
//        {
            //Se pag é feriado e se é final de semana
            if($isHoliday && $pay->isWeekend())
            {
                //Se é pag sáb, se dia é sab e dia menor ou igual pag+2
                if ($pay->isSaturday() && $today->isSaturday() && $today <= $pay->addDays(2)) {
//                    return 'Feriado, sábado e hj menor que pay +2';
            return true;
                }

                if ($pay->isSunday() && $today <= $pay->addDay()) {
//                    return 'Feriado, domingo e hj menor que pay +1';
            return true;
                }
            }

            if ($isHoliday && $pay->isFriday()) {
                if($today <= $pay->addDays(3))
                {
                                    return true;
//                    return 'Venc feriado, venc sexta e hj menor que pay +3';
                }
            }


            //Se é final de semana
            if($pay->isWeekend())
            {
                //Se é pag sáb, se dia é sab e dia menor ou igual pag+2
                if ($pay->isSaturday() && $today->isSaturday() && $today <= $pay->addDays(2)) {
//                        return 'Feriado, sábado e hj menor que pay +2';
                    return true;
                }

                if ($pay->isSunday() && $today <= $pay->addDay()) {
//                        return 'Feriado, domingo e hj menor que pay +1';
                    return true;
                }
            }

            if ($pay->isFriday()) {
                if($today <= $pay->addDays(3))
                {
                    return true;
//                        return 'Venc feriado, venc sexta e hj menor que pay +3';
                }
            }

//            if ($pay->isFriday() && $today <= $pay->addDays(3)) {
//                return 'Feriado, sexta e hj menor que pay +3';
////            return true;
//            }
//
//            if ($pay->isSaturday() && $today <= $pay->addDays(2)) {
//                return 'Feriado, sábado e hj menor que pay +2';
////            return true;
//            }
//
//            if ($pay->isSunday() && $today <= $pay->addDay()) {
//                return 'Feriado, domingo e hj menor que pay +1';
////            return true;
//            }
//
//            if (!$pay->isWeekend() && $today <= $pay->addDay()) {
//                return 'Pag caiu feriado, hj dia de semana e hj menor ou igual ao dia do pagto +1';
////                return true;
//            }





//            if ($pay->isFriday() && $today > $pay && $today <= $pay->addDays(3)) {
//                return 'Não é feriado e sexta';
////            return true;
//            }

//        if ($isHoliday && ($pay->isFriday() || $pay->isWeekend() || $today <= $pay->addDay())) {
//            return true;
//        }


//        if ($isHoliday && ($pay->isWeekend() || $today <= $pay->addDay())) {
//            return 'Feriado e sexta';
////            return true;
//        }
//
//        if (
//            $pay->isWeekend()
//            &&
//            (
//                $today >= $pay->next(Carbon::THURSDAY)
//                ||
//                $today > $pay->addDay()
//            )
//        ) {
//            return true;
//        }
//        }


//        return 'Cobrar juros';
        return false;
    }

    //        if($today <= $pay)
//        {
//            return false;
//        }
//        else
//        {
//            $isHoliday = self::isHoliday($dateInput);
//
//            if($isHoliday)
//            {
//                if($pay->isWeekend())
//                {
//                    if($today >= $pay->next(Carbon::THURSDAY))
//                    {
//                        return true;
//                    }
//                }
//                elseif($today > $pay->addDay())
//                {
//                    return true;
//                }
//            }
//
//            if($pay->isWeekend())
//            {
//                if($today >= $pay->next(Carbon::THURSDAY))
//                {
//                    return true;
//                }
//                elseif($today > $pay->addDay())
//                {
//                    return true;
//                }
//            }
//
//        }
//
//        return false;
}
