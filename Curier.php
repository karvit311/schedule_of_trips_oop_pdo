<?php  
include('database.php');
class Curier  
{   
   private $conn; 
    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }
    
    public function get_curiers()  
    {  
        return $this->conn->query("SELECT * FROM curier")->fetchAll(); 
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