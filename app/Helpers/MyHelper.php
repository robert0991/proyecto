<?php
/**
 * Created by PhpStorm.
 * User: marcelo
 * Date: 25-03-16
 * Time: 07:42 PM
 */

namespace App\Helpers;
use App\Vacation;
use App\Permit;

class MyHelper {
    public static function vacationDays($date){
        $date_current = new \DateTime();
        $date_init =  new \DateTime($date);
        $difference = $date_current->diff($date_init);
        $year_difference = $difference->format('%y');
        $vacation_days = 0;
        if($year_difference <= 5){
            $vacation_days = $year_difference*15;
        }elseif($year_difference > 5 && $year_difference <= 10){
            $vacation_days = 75+($year_difference-5)*20;
        }elseif($year_difference > 10){
            $vacation_days = 75+100+($year_difference-10)*30;
        }
        return $vacation_days;
    }

    public static function vacationTaken($id){
        $days_taken_vacation = Vacation::where('worker_id',$id)->sum('days_taken');
        $days_taken_work_permit = Permit::where('worker_id',$id)->sum('days_taken');
        $seg =Permit::where('worker_id',$id)->sum('hour_in_seconds');
        $seg_a_days = floor($seg / 34200);
        $days_taken = $days_taken_vacation + $days_taken_work_permit + $seg_a_days;
        return $days_taken;
    }
    public static function workPermitDays($id){
        $days_work_permit = Permit::where('worker_id',$id)->sum('days_taken');
        return  $days_work_permit;
    }
    public static function workPermitHours($id){
        $seg_ini =Permit::where('worker_id',$id)->sum('hour_in_seconds');
        $horas = floor($seg_ini/3600);
        $minutos = floor(($seg_ini-($horas*3600))/60);
        $segundos = $seg_ini-($horas*3600)-($minutos*60);
        $days_work_permit = date("H:i:s",strtotime("$horas:$minutos:$segundos"));
        return  $days_work_permit;
    }
    public static function seg_a_dhms($id){
        $seg =Permit::where('worker_id',$id)->sum('hour_in_seconds');
        $d = floor($seg / 34200);
        $h = floor(($seg - ($d * 34200)) / 3600);
        $m = floor(($seg - ($d * 34200) - ($h * 3600)) / 60);
        return  $d;
    }

    public static function stateWorker($state){
        return ($state == 1)? 'ACTIVO' : 'RETIRADO';
    }
} 