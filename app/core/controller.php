<?php

/**
* 
*/
class Controller
{
	public $num_row,$data ;

	public $server;

	public $servername;
	public $username;
	public $password;
	public $db;

	public $conn;

	public function __construct($servername='localhost',$username='root',$password='passw0rd1',$db='company')
	{
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->db = $db;
		$this->setServerInfo();
	}

	public function model($model)
	{
		require_once 'model.php';
		require_once '../app/models/'.$model.'.php';
		return new $model;
	}
	public function view($view,$data = [])
	{
		require_once '../app/views/'.$view.'.php';
	}
	
	
	public function GenerateNewPrimaryCodeEx($ColName,$tableName,$StrConCat)
	{
		 $sql ="SELECT CONCAT('$StrConCat',
			MAX(CAST(REPLACE($ColName, SUBSTR($ColName,1,3), '') 
			AS UNSIGNED))+1) as NEWCODE FROM $tableName";
		$result = mysql_query($sql);
		$result_array = $this->MyFetch($result);
		$data['PrimaryCode']= $result_array[0]['NEWCODE'];
		return $data['PrimaryCode'];
	}
	public function MyRedirect($path,$pagename,$data)
	{
		session_start();
		$_SESSION['data'] = $data;
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = $path;
		$extra = $pagename;
		header("Location: http://$host/$uri/$extra");
		exit;
	}
	public function MyRedirectData($data)
	{
		$_SESSION['data'] = $data;
	}
	public function ProcessData()
	{
		if(isset($_SESSION['data']))
		{
		$this->data = $_SESSION['data'];
		unset($_SESSION['data']);
		}
	}
	

	public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    return $randomString;
    }

    public function setServerInfo() {
 		$this->server = $_SERVER;
    }

    public function getUrl()
    {
    	return $this->server['REQUEST_SCHEME'].'://'.$this->server['SERVER_NAME'];
    }
    
	public function console_log( $data ){
	  echo '<script>';
	  echo 'console.log('. json_encode( $data ,true) .')';
	  echo '</script>';
	}

}

// $main = new Main;
// CREATE
// $inputs['game_code'] = 'abc';
// $inputs['game_json'] = 'abc';
// $inputs['active'] = 1;

// $data = $main->create($inputs,'game_string');
// $data = dd($main);

// Update
// $inputs['game_code'] = 'abc';
// $inputs['game_json'] = 'abc';
// $inputs['active'] = 1;
// $data = $main->update($inputs,'game_code',$inputs['game_code'],'game_string');

// READ
// $data = $main->read('game_code','NDMj1BjsGHW2OTCqiuMlii31zUW2iRO6','game_string');


// DELETE
// $data = $main->delete('game_code','NDMj1BjsGHW2OTCqiuMlii31zUW2iRO6','game_string');


// echo '<pre>'.print_r($data,true);
?>