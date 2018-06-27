<?php
namespace Application\controllers;
use Application\models\Curier;
use Application\models\Schedule;
use Application\models\Region;

class MainController extends \Application\core\Controller
{
    public function actionIndex()
    {
        require_once(ROOT . '/application/views/index.php');
    }
    public function actionSelectPost()
    {   
        require_once(ROOT . '/application/views/select_post.php');
    }
    public function actionAddNewSchedule()
    {   
        require_once(ROOT . '/application/views/add_new_schedule.php');\
    }
    public function actionAddNewRegion()
    {   
        include ('./application/models/Region.php');    
        if((isset($_POST['new_region'])) ){ 
            $new_region = addslashes( $_POST['new_region']);
            $reg = new Region($pdo);
            $stmt = $reg->get_prepare();
            $stmt->execute(array($new_region));
            $count = $stmt->rowCount(); 
            if ( $count>0 ) {
                echo 'count<br>';
            }else{ 
                $curier = new Region($pdo);
                $curier->get_insert($new_region); 
                echo '1';
            } 
        }
    }
    public function actionAddNewCurier()
    {   
        include ('./application/models/Curier.php');  
        if((isset($_POST['new_curier'])) ){ 
            $new_curier = addslashes( $_POST['new_curier']);
            $cur = new Curier($pdo);
            $stmt = $cur->get_prepare();
            $stmt->execute(array($new_curier));
            $count = $stmt->rowCount();
            if ( $count>0 ) {
                echo 'count';
            }else{ 
                $curier = new Curier($pdo);
                $curier->get_insert($new_curier); 
                echo '1';
            } 
        }
    }
    public function actionAddPost()
    {   
        include ('./application/models/Schedule.php');
        include ('./application/models/Curier.php');
        include ('./application/models/Region.php');

        if((isset($_POST['region'])  && isset(($_POST['curier']))) && isset($_POST['date_depart'])) {   
            $date_depart_res = addslashes( $_POST['date_depart']);//06/20/2018 6:13 AM
            $date_depart_res = strtotime("$date_depart_res");
            $date_depart_res = date("m/d/Y H:i:s", $date_depart_res);        
            //время в пути: 375 minuts
            $date_depart = strtotime("$date_depart_res");
            $time_in_road = addslashes(  $_POST['time_in_road']); //375 minuts
            // время прибытия: 06/15/2018 23:38:001
            $total = $time_in_road*2;
            $minutes_to_add = $total;
            $time = new DateTime($date_depart_res); 
            $time->add(new DateInterval('PT' . $total . 'M'));
            $stamp_total_time_in_road = $time->format('m/d/Y H:i:s');

            $reg = new Region($pdo);
            $region = addslashes(  $_POST['region']);
            $stmt = $reg->get_prepare();
            $stmt->execute(array($region));
            foreach ($stmt as $row)
            {
                $region_id = $row['id'];
            }
            $cur = new Curier($pdo);
            $curier = addslashes(  $_POST['curier']);
            $stmt = $cur->get_prepare();
            $stmt->execute(array($curier));
            foreach ($stmt as $row)
            {
                $curier_id = $row['id'];
            }
            $sche = new Schedule($pdo);
            $res = $sche->get_schedules_conditionals();
            $res->execute(array($curier_id, $region_id,$date_depart_res, $stamp_total_time_in_road,$date_depart_res, $stamp_total_time_in_road));
                $count = $res->rowCount();
                if ( $count>0 ) {
                    echo 'count';
                }else{ 
                $schedule = new Schedule($pdo);
                $schedule->get_insert($region_id,$curier_id,$date_depart_res,$time_in_road,$stamp_total_time_in_road);
                echo '1';
            }
        }
        if(isset($_POST['res'])){
            $schedule = new Schedule($pdo);
            $list = $schedule->get_schedules();
            foreach($list as $row) {
                $region_id = $row['region_id'];
                $curier_id = $row['curier_id'];
                $date_depart_res = $row['date_depart'];
                $date_depart = strtotime($date_depart_res);
                // время прибытия: 2018-06-15 06:13
                $minutes_to_add = $row['time_in_road'];
                $time = new DateTime(date('Y-m-d H:i', $date_depart));
                $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $stamp = $time->format('m/d/Y H:i');
                // время в пути: 0 дней, 14 часов, 50 минут
                $minutes = $minutes_to_add;
                $zero    = new DateTime('@0');
                $offset  = new DateTime('@' . $minutes * 60);
                $diff    = $zero->diff($offset);
                $time_in_road = $diff->format('%a дней, %h часов, %i минут');

                $cur = new Curier($pdo);
                $stmt_cur = $cur->get_prepare_by_id();
                $stmt_cur->execute(array($curier_id));
                $reg = new Region($pdo);
                $stmt = $reg->get_prepare_by_id();
                $stmt->execute(array($region_id));
                foreach ($stmt_cur as $row_cur)
                {
                    $curier_id = $row_cur['id'];
                    $curier_name_final = $row_cur['name'];
                    foreach ($stmt as $row)
                    {
                        $region_id = $row['id'];
                        $region_name_final = $row['name'];
                        echo '<ul><li><br>';
                        echo 'Region: '.$region_name_final.'<br>';
                        echo 'Curier: '.$curier_name_final.'<br>';
                        echo 'Date depart: '.$date_depart_res.'<br>';
                        echo 'Time in road: '.$time_in_road.'<br>';
                        echo 'Time arrival: '.$stamp.'<br>';
                        echo '</li></ul>';
                    }
                }
            }
        }   
    }
}