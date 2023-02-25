<?php

/**
* 
*/
class Dept extends Controller
{
	
	public function index()
	{
		$dept = $this->model('deptModel');
		$query = "select * from depts";
		// die("<pre>".print_r($query,true)."</pre>");
		$data = $dept->select($query);

		$data['result'] = [];
		$this->view('dept/list', $data);
	}

	public function list()
	{
		$dept = $this->model('deptModel');
		$query = "select * from depts";
		// die("<pre>".print_r($query,true)."</pre>");
		$data = $dept->select($query);
		$this->view('dept/list', $data);
	}
}

?>