<?php

/**
* 
*/
class Model
{
	public $servername;
	public $username;
	public $password;
	public $db;
	public $num_row,$data ;
	public $conn;
	public $server;
	
	public function __construct($servername='mysql',$username='root',$password='passw0rd1',$db='company')
	{
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->db = $db;
		$this->setServerInfo();
	}

	
    public function setServerInfo() {
 		$this->server = $_SERVER;
    }

    public function getUrl()
    {
    	return $this->server['REQUEST_SCHEME'].'://'.$this->server['SERVER_NAME'];
    }
    
	public function getConnectionStatus()
	{
		try {
		    $this->conn = $conn = new PDO("mysql:host=$this->servername;dbname=$this->db;", $this->username, $this->password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return "Connected successfully";
		    }
		catch(PDOException $e)
		    {
		    return "Connection failed: " . $e->getMessage();
		    }
	}
	public function connect()
	{
		return $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db;", $this->username, $this->password);
	}

	public function select($sql)
	{
		try{
		
		$conn = $this->connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare($sql);

	    $stmt->execute();
	    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
	    $data['result']  = $stmt->fetchAll();
	    $data['count']  = count($data['result']);
	    
			if ($data['count'] > 0) {
			    $data['msg']  = "Record found";
			    $data['status'] =  1;
	    	} else {
			    $data['msg']  = "No Record found";
			    $data['status'] =  0;
	    	}
		    return $data;
		}catch(PDOException  $e ){
			$data['error'] =  $e->getMessage();
		    $data['code'] =  $e->getCode();
		    $data['status'] =  0;
		    return $data;
		}
		
	}

	public function create($inputs,$tablename)
	{
		try{
		$keys = $this->getKeys($inputs);
		
		$values = $this->getValues($inputs);
		
		$key =	implode(",",$keys);
		
		$value = implode("','",$values);

			$sql = "INSERT INTO $tablename($key) VALUES('$value')";
	    	$conn = $this->connect();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			   
	    	$stmt = $conn->prepare($sql);
	    	
	    	foreach ($inputs as $key => $value) {
	    		$stmt->bindParam(':'.$key,$value);
	    	}
	    	
			// var_dump($stmt);exit();
	    	if($stmt->execute()){
	   			$data['msg'] =  'successfully inserted';
			    $data['id'] =  $conn->lastInsertId();
			    $data['status'] =  1;
			    return $data;
		   	}

    	}
		catch(PDOException $e)
		{
			$data['error'] =  $e->getMessage();
		    $data['code'] =  $e->getCode();
		    $data['status'] =  0;
		    return $data;
		}

		
	}

	public function update($inputs,$field,$field_value,$tablename)
	{
		try{
		$string = $this->updateString($inputs);

			$sql = "Update $tablename Set $string where $field='$field_value'";
	    	$conn = $this->connect();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			   
	    	$stmt = $conn->prepare($sql);
	    	
	    	foreach ($inputs as $key => $value) {
	    		$stmt->bindParam(':'.$key,$value);
	    	}
	    	
			// var_dump($stmt);exit();
	    	if($stmt->execute()){
	   			$data['msg'] =  'successfully Updated';
			    $data['status'] =  1;
			    return $data;
		   	}

    	}
		catch(PDOException $e)
		{
			$data['error'] =  $e->getMessage();
		    $data['code'] =  $e->getCode();
		    $data['status'] =  0;
		    return $data;
		}

		
	}

	public function read($field,$field_value,$tablename)
	{

		try{
		$conn = $this->connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql ="Select * from $tablename where $field='$field_value'";
		$stmt = $conn->prepare($sql);
	    $stmt->execute();
	    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
	    $data['result']  = $stmt->fetchAll();
	    $data['count']  = count($data['result']);
	    
			if ($data['count'] > 0) {
			    $data['msg']  = "Record found";
			    $data['status'] =  1;
	    	} else {
			    $data['msg']  = "No Record found";
			    $data['status'] =  0;
	    	}
		    return $data;
		}catch(PDOException  $e ){
			$data['error'] =  $e->getMessage();
		    $data['code'] =  $e->getCode();
		    $data['status'] =  0;
		    return $data;
		}
		
	}

	public function delete($field,$field_value,$tablename)
	{

		try{
		$conn = $this->connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql ="Delete from $tablename where $field='$field_value'";
			try{
				$conn->exec($sql);
				$data['msg'] = "Record deleted successfully";
				$data['status'] =  1;
		    }
			catch(PDOException $e)
		    {
			    $data['msg'] =  $e->getMessage();
			    $data['status'] =  0;
		    }
		    return $data;

		}catch(PDOException  $e ){
			$data['error'] =  $e->getMessage();
		    $data['code'] =  $e->getCode();
		    $data['status'] =  0;
		    return $data;
		}
		
	}

	public function getKeys($inputs)
	{
		foreach ($inputs as $key => $value) {
			$data[] = $key;
		}
		return $data;;
	}
	public function getValues($inputs)
	{

		foreach ($inputs as $key => $value) {
			$data[] = $value;
		}
		return $data;;
	}
	public function updateString($data)
	{
		$UpdateString = array();
		foreach ($data as $key => $value) {
			$values = $key."='".$value."'";
				array_push($UpdateString,$values);
		}
		return join(",",$UpdateString);
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