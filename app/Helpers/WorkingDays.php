<?php


namespace App\Helpers;

use DateTime;
use DateInterval;

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
        if(getDayOfWeek($data)==("Sábado"))
        {
            $data = date('Y-m-d', strtotime($data. ' + 2 days'));
        }
        else if(getDayOfWeek($data)==("Domingo"))
        {
            $data = date('Y-m-d', strtotime($data. '+ 1 days'));
        }
        return $data;
    }

    public static function Workday($data,$DIAS_PGTO=0)
    {
        $holidays= new holidays(date('Y',strtotime($data)));
        $dutil=FALSE;
        while (!$dutil) {
            $data=pay($data,$DIAS_PGTO);
            if (array_value_recursive($data, $holidays) <> NULL)
            {
                $data = date('Y-m-d', strtotime($data. '+ 1 days'));
                $data=pay($data,$DIAS_PGTO);
            }else{
                $dutil=TRUE;
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
            if ($dc == Workday($dc)) $dias_uteis++;
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
            if ($dataCorrente == Workday($dataCorrente)) $i++;
            $dataObjeto = new DateTime($dataCorrente);
            $dataObjeto->add( new DateInterval( "P1D" ) );
            $dataCorrente = $i <= $diasUteis ? $dataObjeto->format( "Y-m-d" ) :  $dataCorrente;
        }
        return $dataCorrente;
    }

    public static function getDataAll(){

        $holidays= self::holidays(2023);

        return $holidays;

//        echo "<pre> sexta santa '2019-04-19' prox dia util->". Workday('2019-04-19')."  ".getDayOfWeek(Workday('2019-04-19'))."</pre>";
//
//        echo "<pre> sabado de carnaval '2019-03-02' prox dia util->". Workday('2019-03-02')."  ".getDayOfWeek(Workday('2019-03-02'))."</pre>";
//
//        echo "<pre> confraternização '2019-01-01' prox dia util->". Workday('2019-01-01')."  ".getDayOfWeek(Workday('2019-01-01'))."</pre>";
//
//        echo "<pre> um sabado '2019-11-30' prox dia util->". Workday('2019-11-30')."  ".getDayOfWeek(Workday('2019-11-30'))."</pre>";
//
//        echo "<pre> dia comum '2019-11-07' prox dia util->". Workday('2019-11-07')."  ".getDayOfWeek(Workday('2019-11-07'))."</pre>";
//
//        echo "<pre> conta dias uteis '2019-03-02' a '2019-03-12' possuem ". conta_dias_uteis('2019-03-02','2019-03-12')." dias úteis</pre>";
//
//        echo "<pre> calcula data baseado em data inicial + dias úteis. Data Inicial = 2019-03-02 dias úteis= 4  a data final é:". calcDataDiaUteis('2019-03-02',4)."<br> Já serve como teste de mesa para função anterior</pre>";

    }

}
