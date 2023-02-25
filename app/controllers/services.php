<?php

/**
* 
*/
class Services extends Controller
{
	
	public function index()
	{
		$dept = $this->model('deptModel');
		$query = "select * from country_mas";
		$data = $dept->select($query);

		$this->view('services/index', $data);
	}

	public function getCountries()
	{
		$model = $this->model('common');
		// die("<pre>".print_r($model,true)."</pre>");
		$query = "select * from country_mas";
		$data = $model->select($query);
		
		return $this->json([ 'data'=> $data['result'] ]);
	}

	

	
}

?>