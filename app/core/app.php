<?php
// ini_set('display_errors',1);
include '../vendor/autoload.php';
/**
* 
*/
class App
{
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];

	function __construct()
	{
		$url = $this->parseUrl();
		// die(print_r($url,true));
		if(!empty($url) && file_exists('../app/controllers/'.$url[0].'.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once '../app/controllers/'. $this->controller .'.php';

		$this->controller = new $this->controller;
		
		if(isset($url[1]))
		{
			if(method_exists($this->controller,$url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : [];
		// print_r($this->params);
		call_user_func_array([$this->controller,$this->method], $this->params);
	}

	public function parseUrl()
	{
		// die("<pre>".print_r($_SERVER['REQUEST_URI'],true)."</pre>");
		if(isset($_SERVER['REQUEST_URI'])){

			return $url = explode('/',filter_var(ltrim(rtrim($_SERVER['REQUEST_URI'],'/'),'/'),FILTER_SANITIZE_URL));
		}
	}
}

?>