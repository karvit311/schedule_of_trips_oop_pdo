<?php 
namespace Application\models; 
use Application\core\App;
class Curier extends \Application\core\DB{
    public $id;
    public $userId;
    public $createdAt;
    public $comment;
    public $host="localhost";
    public $user="root";
    public $dbase="api";
    public $pass="Re_zinaidaromanova311888";
    // private $conn; 
    // public function __construct(\PDO $pdo) {
    //     $this->conn = $pdo;
    // }
    public $conn;
    public $query;
    public function __construct(){

        // $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->dbase,$this->user,$this->pass);
         $this->query = App::$app->get_db(); 

    }
    public function get_curiers()  
    {  
        // $query = App::$app->get_db(); 
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
