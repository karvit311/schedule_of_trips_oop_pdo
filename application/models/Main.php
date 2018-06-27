<?php
namespace Application\models;  
// use Application\models\Db; 
include('database.php');
class Main extends \Application\models\DB 
{   
    public $id;
    public $userId;
    public $createdAt;
    public $comment;
    public $host="localhost";
    public $user="root";
    public $db="api";
    public $pass="Re_zinaidaromanova311888";
    public $conn;
    // private $conn; 
    // public function __construct(\PDO $pdo) {
    //     $this->conn = $pdo;
    // }
    public function __construct(){

 $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
 }
    // public function get_regions()  
    // {  
    //     return $this->conn->query("SELECT * FROM region")->fetchAll(); 
    // } 
    // public function get_prepare()
    // {
    //     return $this->conn->prepare( "SELECT id, name FROM region WHERE name = ?");
    // }  
    // public function get_prepare_by_id()
    // {
    //     return $this->conn->prepare( "SELECT id, name FROM region WHERE id = ?");
    // }        
    // public function get_insert($new_region)
    // {
    //     $stmt = $this->conn->prepare( "INSERT INTO region (name)  VALUES(:name)");
    //     $stmt->bindParam(":name", $new_region, PDO::PARAM_STR);
    //     $stmt->execute();
    // }  
}  
?>  