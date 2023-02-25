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
		$data = $dept->select($query);
		$this->view('dept/list', $data);
	}

	public function list()
	{
		$dept = $this->model('deptModel');
		$query = "select * from depts";
		$data = $dept->select($query);
		$this->view('dept/list', $data);
	}
}

?>