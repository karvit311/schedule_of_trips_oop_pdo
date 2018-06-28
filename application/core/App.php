<?php
namespace Application\core;
class App
{
	private $db;
	private $router;

	public static $app;
	private $host="localhost";
	private $user="root";
	private $dbase="api";
	private $pass="Re_zinaidaromanova311888";
	// 'dsn' => 'mysql:host=localhost;dbname=yii2basic',
 //    'username' => 'root',
 //    'password' => '',
 //    'charset' => 'utf8',

	public function __construct()
	{
		static::$app = $this;
		// $this->app = $app;

		$this->router = new \Application\core\Router(); 
		$this->db = new \PDO("mysql:host=".$this->host.";dbname=".$this->dbase,$this->user,$this->pass); 	
	}
	public function run()
	{
		$this->router->run();
	}
	function set_db($db) 
	{
		$this->db = $db;
		// $this->db =new \PDO("mysql:host=".$this->host.";dbname=".$this->dbase,$this->user,$this->pass);
		// $this->db->connect();

	}
	function get_db() 
	{
		return $this->db;
	}
}
?>
