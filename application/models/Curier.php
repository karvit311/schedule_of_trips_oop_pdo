<?php 
namespace Application\models; 
use Application\core\App;

class Curier 
{
    public $conn;

    public function get_curiers()  
    {  
        $conn = App::$app->getDb(); 
        return $conn->rawSql("SELECT * FROM curier")->fetchAll(); 
    }      
    public function get_prepare($new_curier)
    {
        $conn = App::$app->getDb(); 
        $stmt = $conn->query("SELECT id, name FROM curier WHERE name = ?");
        $stmt->bindParam(1, $new_curier);
        return $stmt;
    } 
    public function get_prepare_by_id($curier_id)
    {
        $conn = App::$app->getDb(); 
        $stmt = $conn->query("SELECT id, name FROM curier WHERE id = ?");
        $stmt->bindParam(1, $curier_id);
        return $stmt;
    }        
    public function insert($new_curier)
    {
        $conn = App::$app->getDb();
        $stmt = $conn->query( "INSERT INTO curier (name)  VALUES(:name)");
        $stmt->bindParam(":name", $new_curier, \PDO::PARAM_STR);
        $stmt->execute();
    }  
}  
?>  
