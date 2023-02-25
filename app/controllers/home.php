<?php

/**
* 
*/
class Home extends Controller
{
	
	public function index($name = '',$otherName ='')
	{
		$data  =[];
		$data['name'] = $name;
		$data['otherName'] = $otherName;
		// die('<pre>'.print_r($data,true).'</pre>');
		$this->view('home/index',$data);
	}

	public function test(){
		echo 'test';
	}
}

?>