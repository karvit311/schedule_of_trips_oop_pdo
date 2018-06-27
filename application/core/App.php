<?php
namespace Application\core;
// include('database.php');
class App
{
	private $db;
	private $router;

	public static $app;
	private $host="localhost";
	private $user="root";
	private $dbase="api";
	private $pass="Re_zinaidaromanova311888";

	public function __construct()
	{
		static::$app = $this;
		$this->router = new \Application\core\Router(); 
		// $this->db = new \PDO("mysql:host=".$this->host.";dbname=".$this->dbase,$this->user,$this->pass);
		$this->db = new \Application\core\DB(); 	

	}
	public function run()
	{
		$this->router->run();
	}
	function set_db($db) 
	{
		$this->db = $db;
	}
	function get_db() 
	{
		return $this->db;
	}
}
?>