<?php 
namespace Application\models;  
use Application\core\App;
include('database.php');
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
}  
?>  