<?php 
namespace Application\models; 
use Application\core\App;
include('database.php');
class Curier extends \Application\core\DB{
    public $id;
    public $userId;
    public $createdAt;
    public $comment;
    public $host="localhost";
    public $user="root";
    public $db="api";
    public $pass="Re_zinaidaromanova311888";
    // private $conn; 
    // public function __construct(\PDO $pdo) {
    //     $this->conn = $pdo;
    // }
    public $conn;
    public function __construct(){

        $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
    }
    public function get_curiers()  
    {  
        $query = App::$app->get_db();   

        return $this->query->query("SELECT * FROM curier")->fetchAll(); 
    }      
    public function get_prepare()
    {
        return $this->conn->prepare( "SELECT id, name FROM curier WHERE name = ?");
    } 
    public function get_prepare_by_id()
    {
        return $this->conn->prepare( "SELECT id, name FROM curier WHERE id = ?");
    }        
    public function get_insert($new_curier)
    {
        $stmt = $this->conn->prepare( "INSERT INTO curier (name)  VALUES(:name)");
        $stmt->bindParam(":name", $new_curier, PDO::PARAM_STR);
        $stmt->execute();
    }  
}  
?>  