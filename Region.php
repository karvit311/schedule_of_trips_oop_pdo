<?php  
include('database.php');
class Region  
{   
    private $conn; 
    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }
    public function get_regions()  
    {  
        return $this->conn->query("SELECT * FROM region")->fetchAll(); 
    } 
    public function get_prepare()
    {
        return $this->conn->prepare( "SELECT id, name FROM region WHERE name = ?");
    }  
    public function get_prepare_by_id()
    {
        return $this->conn->prepare( "SELECT id, name FROM region WHERE id = ?");
    }        
    public function get_insert($new_region)
    {
        $stmt = $this->conn->prepare( "INSERT INTO region (name)  VALUES(:name)");
        $stmt->bindParam(":name", $new_region, PDO::PARAM_STR);
        $stmt->execute();
    }  
}  
?>  