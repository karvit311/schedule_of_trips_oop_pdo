<?php
namespace Application\core;
class App
{
	private $db;
	private $router;

	public static $app;

	public function __construct()
	{
		static::$app = $this;
		$this->router = new \Application\core\Router(); 
		$this->db = new \Application\core\DB();
				
	}
	public function run()
	{
		$this->router->run();
	}
	function set_db($db) 
	{
		$this->name = $db;
	}
	function get_db() 
	{
		return $this->db;
	}
}
?>