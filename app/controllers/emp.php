<?php

/**
* 
*/
class Emp extends Controller
{
	
	public function index()
	{
		$dept = $this->model('deptModel');
		$query = "select * from depts";
		$data = $dept->select($query);

		$this->view('emp/index', $data);
	}

	public function list()
	{
		$emp = $this->model('empModel');
		$query = "select * from emps left join depts on emps.deptID = depts.deptID ";
		$data = $emp->select($query);
		$this->view('emp/list', $data);
	}

	public function add()
	{
		$dept = $this->model('deptModel');
		$data = $dept->create($_POST, 'emps');
		$this->MyRedirect('emp/list', '', '');
	}

	public function delete($empID)
	{
		$emp = $this->model('empModel');
		$data = $emp->delete('empID', $empID, 'emps');
		$this->MyRedirect('emp/list', '', '');
	}
}

?>