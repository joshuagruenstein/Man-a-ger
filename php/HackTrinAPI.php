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
		} elseif(isset($_POST['productID']) && isset($_POST['checkout'])) {

			$this->insert("UPDATE Entry set checkedOut = '".date('Y-m-d H:i:s')."' WHERE productID = {$_POST['productID']} LIMIT 1");
		} elseif (isset($_POST['productID'])) {

			$this->insert("INSERT INTO Entry (productID, checkedIn) VALUES ('{$_POST['productID']}', '".date('Y-m-d H:i:s')."')");
		} else {
			return $this->selectMultiple("SELECT * FROM Entry");
		}
	}

	private function isMatch($itemName, $words) {
		var_dump($itemName);
		$itemWords = explode(" ", $itemName);
		$isMatch = false;
		foreach($itemWords as $word1) {
			foreach($words as $word2) {
				if(strcmp($word1, $word2) == 0) {
					return true;
					break;
				}
			}
		}
		return false;
	}

	private function postRequest($url, $data) {
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data),
		    ),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { return "ERROR"; }
		var_dump($result);
		return $result;
	}

	protected function delivery() {
		if(isset($_GET['productID'])) {
			/*$productArray = $this->select("SELECT * FROM Product WHERE productID = {$_GET['productID']}");
			$words = explode(" ", $productArray['description']);
			$merchantMenu = json_decode(file_get_contents("https://api.delivery.com/merchant/998/menu?client_id=ZDliNzM4YjVhNjc4OWEzMTI4YmMxNDlkNzlmNDZjNmE5"));
			//var_dump($merchantMenu->menu);
			foreach($merchantMenu->menu[23]->children as $item) {
				if($this->isMatch($item->name, $words)) {
					$this->postRequest( "https://api.delivery.com/third_party/account/create", json_decode("{
 \"access_token\": \"b8cbc26447696b07e45bfefdf56c645c56ae7512e6a5a0.08241105~44\",
 \"token_type\": \"bearer\",
 \"expires\": 1391014905,
 \"expires_in\": 3600,
 \"refresh_token\": \"a3Z55n5hP09hCVyLV6NlNwQzXl9RLuz1dXF4yQUv\"
}"));
					$this->postRequest("https://api.delivery.com/customer/cart/998", array(
						"order_type" => "delivery",
						"instructions" => "yolo",
						"item" => array(
							"item_id" => $item->id,
    						"item_qty" => 1),
						"client_id" => "ZDliNzM4YjVhNjc4OWEzMTI4YmMxNDlkNzlmNDZjNmE5"));
					$this->postRequest("https://api.delivery.com/customer/cart/998/checkout", json_decode("{
  \"tip\": 1.00,
  \"location_id\": 998,
  \"instructions\": \"Don't burn my toast again, grandma!\",
  \"payments\": [
    {
      \"type\": \"credit_card\",
      \"id\": 1
    }
  ],
  \"order_type\": \"delivery\",
  \"order_time\": \"2014-01-19T08:00:00-0500\"
}"));
					break;
				}
			}*/
		}
	}
}

 ?>
