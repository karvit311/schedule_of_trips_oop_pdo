<?php 
namespace Application\models;  
use Application\core\App;
class Schedule extends \Application\core\Model
{   
    public $host="localhost";
    public $user="root";
    public $dbase="api";
    public $pass="Re_zinaidaromanova311888";
    public $conn;
    public $db;
    public $router;
    public function __construct(){
        $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->dbase,$this->user,$this->pass);
    }

    public function get_schedules()  
    {     
    $query = App::$app->get_db($db,$router);   
        return $this->query->query("SELECT * FROM schedule ORDER BY date_depart ASC")->fetchAll(); 
    }
    public function get_schedules_conditionals()  
    {  
        return $this->conn->prepare("SELECT * FROM schedule WHERE (curier_id=?) AND (region_id= ?) AND (date_depart BETWEEN ? AND ? OR  date_arrival BETWEEN ? AND ? ) ");
    }
    public function get_schedules_selects()  
    {  
        // $query = App::$app->get_db($this->conn);  
        return $this->conn->prepare("SELECT * FROM schedule WHERE ( date_depart BETWEEN ? AND ? ) ORDER BY date_depart ASC  ");
    }
    public function get_insert($region_id,$curier_id,$date_depart_res,$time_in_road,$stamp_total_time_in_road)
    {
        $stmt = $this->conn->prepare( "INSERT INTO schedule (region_id,curier_id,date_depart,time_in_road,date_arrival)  VALUES(:region_id,:curier_id,:date_depart,:time_in_road,:date_arrival)");
        $stmt->bindParam(":curier_id", $curier_id, PDO::PARAM_INT);
        $stmt->bindParam(":region_id", $region_id, PDO::PARAM_INT);
        $stmt->bindParam(":date_depart", $date_depart_res, PDO::PARAM_STR);
        $stmt->bindParam(":time_in_road", $time_in_road, PDO::PARAM_STR);
        $stmt->bindParam(":date_arrival", $stamp_total_time_in_road, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function add_post($region,$curier,$date_depart,$time_in_road)
    {
        if((isset($region)  && isset($curier)) && isset($date_depart) && isset($time_in_road)) {   
            $date_depart_res = addslashes( $date_depart);//06/20/2018 6:13 AM
            $date_depart_res = strtotime("$date_depart_res");
            $date_depart_res = date("m/d/Y H:i:s", $date_depart_res);        
            //время в пути: 375 minuts
            $date_depart = strtotime("$date_depart_res");
            $time_in_road = addslashes(  $time_in_road); //375 minuts
            // время прибытия: 06/15/2018 23:38:001
            $total = $time_in_road*2;
            $minutes_to_add = $total;
            $time = new DateTime($date_depart_res); 
            $time->add(new DateInterval('PT' . $total . 'M'));
            $stamp_total_time_in_road = $time->format('m/d/Y H:i:s');
            $reg = new Region($pdo);
            $region = addslashes($region);
            $stmt = $reg->get_prepare();
            $stmt->execute(array($region));
            foreach ($stmt as $row)
            {
                $region_id = $row['id'];
            }
            $cur = new Curier($pdo);
            $curier = addslashes($curier);
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

    }
    public function get_res($res)
    {
        if(isset($res){
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
                $zero = new DateTime('@0');
                $offset = new DateTime('@' . $minutes * 60);
                $diff = $zero->diff($offset);
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
?>  
