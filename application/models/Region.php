<?php
namespace Application\models;  
use Application\core\App;

class Region  
{   
    public $conn;

    public function get_regions()  
    {  
        $conn = App::$app->getDb();
        return $conn->rawSql("SELECT * FROM region")->fetchAll(); 
    } 
    public function get_prepare($new_region)
    {
        $conn = App::$app->getDb(); 
        $stmt = $conn->query("SELECT id, name FROM region WHERE name = ?");
        $stmt->bindParam(1, $new_region);
        return $stmt;
    }  
    public function get_prepare_by_id($region_id)
    {
        $conn = App::$app->getDb(); 
        $stmt = $conn->query("SELECT id, name FROM region WHERE id = ?");
        $stmt->bindParam(1, $region_id);
        return $stmt;
    }        
    public function insert($new_region)
    {
        $conn = App::$app->getDb(); 
        $stmt = $conn->query( "INSERT INTO region (name)  VALUES(:name)");
        $stmt->bindParam(":name", $new_region, \PDO::PARAM_STR);
        $stmt->execute();
    }  
}  
?>  
