<?php

require_once 'API.class.php';

class HackTrinAPI extends API
{

	// The database
	private $mysqli;
	private $config;

	public function __construct($request, $origin) {
		$this->config = include('config.php');

		$this->initDB();

		$this->sanitizeHTTPParameters();
		
		parent::__construct($request);
	}

	private function sanitizeHTTPParameters() {
		foreach ($_GET as $key => $value) {
			$_GET[$key] = escapeshellcmd($this->mysqli->real_escape_string($value));
		}
		foreach ($_POST as $key => $value) {
			$_POST[$key] = escapeshellcmd($this->mysqli->real_escape_string($value));
		}
	}

	private function encryptPassword($password) {
		return $this->mysqli->real_escape_string(crypt($password, $this->config['salt']));
	}

	// Initializes and returns a mysqli object that represents our mysql database
	private function initDB() {
		$this->mysqli = new mysqli($this->config['hostname'], 
			$this->config['username'], 
			$this->config['password'], 
			$this->config['databaseName']);

		if (mysqli_connect_errno()) { 
			echo "<br><br>There seems to be a problem with our database. Reload the page or try again later.";
			exit(); 
		}
	}

	private function select($sql) {
		$res = mysqli_query($this->mysqli, $sql);
		if($res) return mysqli_fetch_array($res, MYSQLI_ASSOC);
		else return NULL;
	}

	private function selectMultiple($sql) {
		$res = mysqli_query($this->mysqli, $sql);
		$finalArray = array();

		while($temp = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
			array_push($finalArray, $temp);
		}

		return $finalArray;
	}

	private function insert($sql) {
		mysqli_query($this->mysqli, $sql);
	}

	// ENDPOINTS
	protected function product() {
		if(isset($_GET['productID'])) {
			return $this->select("SELECT * FROM Product WHERE productID = {$_GET['productID']}");
		} elseif(isset($_POST['productID'])
			&& isset($_POST['ingredients'])
			&& isset($_POST['nutrition'])
			&& isset($_POST['usageInfo'])
			&& isset($_POST['brand'])
			&& isset($_POST['description'])) {
			
			$this->insert("INSERT INTO Product (productID, ingredients, nutrition, usageInfo, brand, description) VALUES ('{$_POST['productID']}', '{$_POST['ingredients']}', '{$_POST['nutrition']}', '{$_POST['usageInfo']}', '{$_POST['brand']}', '{$_POST['description']}')");
		} else {
			return $this->selectMultiple("SELECT * FROM Product");
		}
	}

	protected function entry() {
		if(isset($_GET['productID'])) {
			return $this->selectMultiple("SELECT * FROM Entry WHERE productID = {$_GET['productID']}");
		} elseif (isset($_POST['productID'])) {

			$this->insert("INSERT INTO Entry (productID, checkedIn) VALUES ('{$_POST['productID']}', '".date('Y-m-d H:i:s')."')");
		} elseif(isset($_POST['productID']) && isset($_POST['checkout'])) {

			$this->insert("UPDATE Entry set checkedOut = '".date('Y-m-d H:i:s')."' WHERE productID = {$_POST['productID']} LIMIT 1");
		} else {
			return $this->selectMultiple("SELECT * FROM Entry");
		}
	}

	protected function delivery() {
		if(isset($_GET['productID'])) {
			$merchantMenu = json_decode(file_get_contents("https://api.delivery.com/merchant/71699/menu?client_id=ZDliNzM4YjVhNjc4OWEzMTI4YmMxNDlkNzlmNDZjNmE5"));
			var_dump($merchantMenu->menu);

		}
	}
}

 ?>
