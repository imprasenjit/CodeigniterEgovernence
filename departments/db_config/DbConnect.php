<?php
include_once dirname(__FILE__) . '/Config.php';
/**
 * Handling database connection
 *
 * @author Chiranjit Das
 */

class DbConnect {
 
    private $dicc_conn;
    private $dept_conn;
 
    function __construct() { 
		
    }
 
    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect() {
        //include_once dirname(__FILE__) . '/Config.php';
 
        // Connecting to mysql database
        $this->dicc_conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
 
        // returing connection resource
        return $this->dicc_conn;
    }
    function dept_connect($dept) {
       // include_once dirname(__FILE__) . '/Config.php';
	   switch($dept){
		   case "labour" : $database="eodbci_comr";
		   break;
		   default : $database="eodbci_".$dept;
		   break;
 	   }
        // Connecting to mysql database
        $dept_conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, $database);
 
        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
 
        // returning connection resource
        return $dept_conn;
    }
	public function executeQuery($dept,$query){
		$dept_conn = $this->dept_connect($dept);			
		$result=$dept_conn->query($query) OR die("Error in SQL QUERY - ".$query.": ".$dept_conn->error);
		$dept_conn->close();
		return $result;
	}
	public function executeQueryInsertID($dept,$query){
		$dept_conn = $this->dept_connect($dept);			
		$result=$dept_conn->query($query) OR die("Error in SQL QUERY : ".$dept_conn->error);
		$insert_id = $dept_conn->insert_id;
		$dept_conn->close();
		return $insert_id;
	}
	public function protect($v){
		$mysqli=$this->connect();
		//global $mysqli;
		$v = trim($v);
		$v = stripslashes($v);
		$v = htmlentities($v, ENT_QUOTES);
		$v = mysqli_real_escape_string($mysqli, $v); 
		$v= strtoupper($v);
		$mysqli->close();
		return $v;
	} 
	public function clean($v) {
		//global $mysqli;
		$mysqli=$this->connect();
		$v = trim($v);
		$v = stripslashes($v);
		$v = htmlentities($v, ENT_QUOTES);
		$v = mysqli_real_escape_string($mysqli, $v);
		$mysqli->close();
		return $v;
	}
	public function escape_string($v) {
		$mysqli=$this->connect();
		$v = trim($v);
		$v=str_replace("\r","",$v);
		$v=str_replace("\n","<br/>",$v);
		$v = mysqli_real_escape_string($mysqli, $v);
		$mysqli->close();
		return $v;
	}

	public function encryptString($plaintext, $key = null) {
		//$key should have been previously generated in a cryptographically safe way, like openssl_random_pseudo_bytes
		//$plaintext = "message to be encrypted";
		$key = 'Q29EZTJkMGIxbzZlZW9kYkNvRGUyZDBiMW82ZWVvZGI==';
		// Remove the base64 encoding from our key
		$encryption_key = base64_decode($key);
		// Generate an initialization vector
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		// Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
		$encrypted = openssl_encrypt($plaintext, 'aes-256-cbc', $encryption_key, 0, $iv);
		// The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
		return base64_encode($encrypted . '::' . $iv);		
	}
	public function decryptString($data, $key = null) {		
		$key = 'Q29EZTJkMGIxbzZlZW9kYkNvRGUyZDBiMW82ZWVvZGI==';
		// Remove the base64 encoding from our key
		$encryption_key = base64_decode($key);
		// To decrypt, split the encrypted data from our IV - our unique separator used was "::"
		list($ciphertext, $iv) = explode('::', base64_decode($data), 2);
		return openssl_decrypt($ciphertext, 'aes-256-cbc', $encryption_key, 0, $iv);

	}
	
}
function clean($v) {
    $v = trim($v);
    $v = stripslashes($v);
    $v = htmlentities($v, ENT_QUOTES);
    return $v;
}
?>