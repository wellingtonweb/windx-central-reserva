<?php


namespace App\Helpers;

use DateTime;
use DateInterval;
use Carbon\Carbon;
use function Symfony\Component\String\b;

class WorkingDays
{

    public static function getDayOfWeek($timestamp)
    {
        $timestamp = strtotime($timestamp);
        $date = getdate($timestamp);
        $diaSemana = $date['weekday'];
        if(preg_match('/(sunday|domingo)/mi',$diaSemana)) $diaSemana = 'Domingo';
        else if(preg_match('/(monday|segunda)/mi',$diaSemana)) $diaSemana = 'Segunda';
        else if(preg_match('/(tuesday|terça)/mi',$diaSemana)) $diaSemana = 'Terça';
        else if(preg_match('/(wednesday|quarta)/mi',$diaSemana)) $diaSemana = 'Quarta';
        else if(preg_match('/(thursday|quinta)/mi',$diaSemana)) $diaSemana = 'Quinta';
        else if(preg_match('/(friday|sexta)/mi',$diaSemana)) $diaSemana = 'Sexta';
        else if(preg_match('/(saturday|sábado)/mi',$diaSemana)) $diaSemana = 'Sábado';
        return $diaSemana;
    }

    public static function pay($data,$DIAS_PGTO=0)
    {
        $data = date('Y-m-d', strtotime($data. '+ '.$DIAS_PGTO.' days'));
        if(self::getDayOfWeek($data)==("Sábado"))
        {
            $data = date('Y-m-d', strtotime($data. ' + 2 days'));
        }
        else if(self::getDayOfWeek($data)==("Domingo"))
        {
            $data = date('Y-m-d', strtotime($data. '+ 1 days'));
        }
        return $data;
    }

    public static function Workday($data,$DIAS_PGTO=0)
    {
        $holidays = self::holidays(date('Y',strtotime($data)));
        $dutil = FALSE;
        while (!$dutil) {
            $data = self::pay($data,$DIAS_PGTO);
            if (self::array_value_recursive($data, $holidays) <> NULL)
            {
                $data = date('Y-m-d', strtotime($data. '+ 1 days'));
                $data = self::pay($data,$DIAS_PGTO);
            }else{
                $dutil = TRUE;
            }
        }
        return $data;
    }

    public static function EasterDate($Ano)  {
        $Rest =($Ano % 19)+1;
        switch ($Rest) {
            case 1: $Dia = mktime(0,0,0, 4, 14, $Ano); break;
            case 2: $Dia = mktime(0,0,0, 4, 3, $Ano); break;
            case 3: $Dia = mktime(0,0,0, 3, 23, $Ano); break;
            case 4: $Dia = mktime(0,0,0, 4, 11, $Ano); break;
            case 5: $Dia = mktime(0,0,0, 3, 31, $Ano); break;
            case 6: $Dia = mktime(0,0,0, 4, 18, $Ano); break;
            case 7: $Dia = mktime(0,0,0, 4, 8, $Ano); break;
            case 8: $Dia = mktime(0,0,0, 3, 28, $Ano); break;
            case 9: $Dia = mktime(0,0,0, 4, 16, $Ano); break;
            case 10: $Dia = mktime(0,0,0, 4, 5, $Ano); break;
            case 11: $Dia = mktime(0,0,0, 3, 25, $Ano); break;
            case 12: $Dia = mktime(0,0,0, 4, 13, $Ano); break;
            case 13: $Dia = mktime(0,0,0, 4, 2, $Ano); break;
            case 14: $Dia = mktime(0,0,0, 3, 22, $Ano); break;
            case 15: $Dia = mktime(0,0,0, 4, 10, $Ano); break;
            case 16: $Dia = mktime(0,0,0, 3, 30, $Ano); break;
            case 17: $Dia = mktime(0,0,0, 4, 17, $Ano); break;
            case 18: $Dia = mktime(0,0,0, 4, 7, $Ano); break;
            case 19: $Dia = mktime(0,0,0, 3, 27, $Ano); break;
        }
        $Ret = "";
        for ($n=1; $n<=13; $n++) {
            $Dia+=86400;

            if (date('l',$Dia)=="Sunday"){
                $dd = date('d',$Dia);
                $mm = date('m',$Dia);
                return date('Y-m-d',$Dia);
            }
        }
        return "";
    }

    public static function holidays($ano)
    {
        $holidays[$ano.'-01-01']='Confraternização Universal';
        $holidays[$ano.'-04-07']='Paixão de Cristo';
        $holidays[$ano.'-04-21']='Tiradentes';
        $holidays[$ano.'-05-01']='Dia do Trabalho';
        $holidays[$ano.'-09-07']='Proclamação da Independência';
        $holidays[$ano.'-10-12']='Nossa Srª Aparecida';
        $holidays[$ano.'-11-02']='Finados';
        $holidays[$ano.'-11-15']='Proclamação da República';
        $holidays[$ano.'-12-25']='Natal';

        $easter= self::EasterDate($ano);

        $holidays[date('Y-m-d', strtotime($easter. ' - 48 days'))]='Segunda de Carnaval';
        $holidays[date('Y-m-d', strtotime($easter. ' - 47 days'))]='Terça de Carnaval';
        $holidays[date('Y-m-d', strtotime($easter. ' - 2 days'))]='Sexta-Feira da Paixão';
        $holidays[$easter]='Páscoa';
        $holidays[date('Y-m-d', strtotime($easter. ' + 60 days'))]='Corpus Christi';

        return $holidays;

    }

    public static function array_value_recursive($key, array $arr){
        $val = array();
        array_walk_recursive($arr, function($v, $k) use($key, &$val){
            if($k == $key) array_push($val, $v);
        });
        return count($val) > 1 ? $val : array_pop($val);
    }

    public static function conta_dias_uteis($di, $df) {
        $dias_uteis =0;
        $dc = $di;
        while ($df > $dc) {
            if ($dc == self::Workday($dc)) $dias_uteis++;
            $do = new DateTime($dc);
            $do->add( new DateInterval( "P1D" ) );
            $dc = $do->format( "Y-m-d" ) ;
        }
        return $dias_uteis;
    }
    //Aqui aplicando Clean Code
    public static function calcDataDiaUteis($dataInicial, $diasUteis) {
        $dataCorrente = $dataInicial;
        $i = 0;
        while ($i <= $diasUteis) {
            if ($dataCorrente == self::Workday($dataCorrente)) $i++;
            $dataObjeto = new DateTime($dataCorrente);
            $dataObjeto->add( new DateInterval( "P1D" ) );
            $dataCorrente = $i <= $diasUteis ? $dataObjeto->format( "Y-m-d" ) :  $dataCorrente;
        }
        return $dataCorrente;
    }

    public static function checkDate($pay)
    {
        $pay = date('Y-m-d', strtotime($pay));

        $workDay = self::Workday($pay);

//        dd($pay);

        if($pay === $workDay){
            return true;
        }

        return false;
    }

    public static function pay2($data,$DIAS_PGTO=0)
    {
        $pay = date('Y-m-d', strtotime($data));

        $data = date('Y-m-d', strtotime($data. '+ '.$DIAS_PGTO.' days'));
        if(self::getDayOfWeek($data)==("Sábado"))
        {
            $data = date('Y-m-d', strtotime($data. ' + 3 days'));
        }
        else if(self::getDayOfWeek($data)==("Domingo"))
        {
            $data = date('Y-m-d', strtotime($data. '+ 2 days'));
        }

//        $data = [
//            'pay' => $pay,
//            'data' => $data,
//            'days' => self::conta_dias_uteis($pay, $data)
//        ];

        return $data - $pay;
    }

    public static function getDataAll(){

        $holidays= self::holidays(2023);

//        return $holidays;

        echo "<pre> Tiradentes '2023-04-21' prox dia util->". self::Workday('2023-04-21')."  ".self::getDayOfWeek(self::Workday('2023-04-21'))."</pre>";

        echo "<pre> Independência do Brasil '2023-09-07' prox dia util->". self::Workday('2023-09-07')."  ".self::getDayOfWeek(self::Workday('2023-09-07'))."</pre>";
//
//        echo "<pre> sabado de carnaval '2023-02-18' prox dia util->". self::Workday('2023-02-18')."  ".self::getDayOfWeek(self::Workday('2023-02-18'))."</pre>";
//
        echo "<pre> confraternização '2023-01-01' prox dia util->". self::Workday('2023-01-01')."  ".self::getDayOfWeek(self::Workday('2023-01-01'))."</pre>";
//
        echo "<pre> um sabado '2023-07-22' prox dia util->". self::Workday('2023-07-22')."  ".self::getDayOfWeek(self::Workday('2023-07-22'))."</pre>";
//
        echo "<pre> dia comum '2023-07-19' prox dia util->". self::Workday('2023-07-19')."  ".self::getDayOfWeek(self::Workday('2023-07-19'))."</pre>";
//
        echo "<pre> conta dias uteis '2024-02-12' a '2024-02-17' possuem ". self::conta_dias_uteis('2024-02-12','2024-02-17')." dias úteis</pre>";
//
        echo "<pre> calcula data baseado em data inicial + dias úteis. Data Inicial = 2023-03-07 dias úteis= 4  a data final é:". self::calcDataDiaUteis('2023-03-07',4)."<br> Já serve como teste de mesa para função anterior</pre>";

    }

    function isSaturdayOrSunday($dateString) {
//        date_default_timezone_set('America/Sao_Paulo');

        $response = '';

        // Cria um objeto DateTime a partir da string da data

        $date = new DateTime($dateString);

        $today = new DateTime();

//        $diff = $today->diff($date);

//        $diff = $today > $date;

//        if($diff > 0)

//        dd($today, $date);
//
//        // Obtém o valor do dia da semana (1 para segunda-feira, 2 para terça-feira, ..., 6 para sábado, 7 para domingo)
//        $dayOfWeek = (int)$date->format('N');
//
//        if($dayOfWeek === 6){
//            $response = 'Sábado ' . ($date < $today ? 'em dia' : 'vencido');
//        }elseif($dayOfWeek === 7){
//            $response = 'Domingo ' . ($date < $today ? 'em dia' : 'vencido');
//        }else{
//            $response = 'Dia útil ' . ($date < $today ? 'em dia' : 'vencido');
//        }
//
//        // Retorna verdadeiro se for sábado (6) ou domingo (7)
////        return $dayOfWeek === 6 || $dayOfWeek === 7;
//        $dt = $date->diff($today);

        $d = [
            'yesterday' => Carbon::yesterday(),
            'today' => Carbon::today(),
            'tomorrow' => Carbon::tomorrow(),
            'pay' => new Carbon($dateString),
        ];

//      -------------------------------------------------------

//        $t = $d['pay']->diff($d['hoje']);

//        $dt = Carbon::now();

        if($d['pay']->dayOfWeek > 5){
            if($d['pay'] == $d['tomorrow']){
                return true;
            }
        }

        return false;
    }

    //isHoliday e hasFees funcionando OK em modo teste.

    public static function isHoliday($dateInput)
    {
        $holidays = self::holidays(date('Y',strtotime($dateInput)));

        $dateInput = date('Y-m-d', strtotime($dateInput));

        $isHoliday = false;

        foreach ($holidays as $key => $holiday){
            $dateInput == $key ? $isHoliday = true : '';
        }

        return $isHoliday;
    }

    public static function hasFees($dateInput)
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $pay = new Carbon($dateInput);
//        $current = Carbon::now();

//        $response = [
//            'anterior' => false,
//            'fimDeSemana' => false,
//            'dentroDoPeriodo' => false,
//            'dias' => $pay->diffInDays($today),
//        ];

        //se for anterior e a diferença entre data do vencimento e data do pagamento for menor que 4
        if($pay->lessThan($today) && $pay->diffInDays($today) < 4){
//            $response['anterior'] = true;
            //se for final de semana
            if($pay->dayOfWeek > 5){
//                $response['fimDeSemana'] = true;
                if($pay->diffInDays($today) < 3){
//                    $response['dentroDoPeriodo'] = true;
                    return true;
                }
            }
        }

        return false;
    }

}
