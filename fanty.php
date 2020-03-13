<?php

define("WEBPATH", "http://".$_SERVER['HTTP_HOST']);
define("cryptKey", "00pkkajdnnr443dd");

class db
{
	private $host;
	private $user;
	private $pass;
	private $db;
	public $errors;
	public $con;
	function __construct($host='localhost',$user='root',$pass='',$db='email_tracker'){
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
		$this->connection();
	}
	function timedate(){
		return date("d-M-Y H:i:s");
	}
	function stringpass2($string){
		$tmp = str_replace(" ", "", str_replace("'", "", $string));
		$tmp = str_replace('	', "", $tmp);
		return $tmp;
	}
	function amount($amount){
		if ($amount=='-') {
			return '-';
		}
		$raw = explode('.', $amount);
		$amount = $raw[0];
		if ($amount=='') {
			$amount = 0;
		}
		if (count($raw)==2) {
			$decimel = $raw[1];
		}else{
			$decimel = '00';
		}
		$pieces = str_split($amount);
		
		$flag = 0;
		if ($pieces[0]=='-') {
			$flag = 1;
			unset($pieces[0]);	
		}
		$pieces = array_reverse($pieces);
		$new = array();
		$i=0;
		foreach ($pieces as $key => $value) {
			if ( $i <=3 && (($i%3==0) && $i>=3)) {
				array_push($new, ',');
			}else if($i >4 && !($i%2==0)) {
				array_push($new, ',');
			}
			
			array_push($new, $value);
			$i++;
		}
		$new = array_reverse($new);
		$new = implode("", $new);
		if ($flag) {
			$new = '-'.$new;
		}
		return $new.'.'.$decimel;
	}
	function stringpass1($string){
		return str_replace("'", "", $string);
	}
	function stringpass($string){
		$f = mysqli_real_escape_string($this->con, $string);
		$f = str_replace("'", "", $f);
		return $f;
	}
	function ask($query, $parameter=1){
		if ($query=='return true') {
			return True;
		}
		if($parameter!=1){ $query = mysqli_real_escape_string($this->con, $query); }
		$query = mysqli_query($this->con, $query);
		return $query;
	}
	function convert($query){
		$product=array();
		for ($i=0; $row=mysqli_fetch_array($query) ; $i++) {
			$product[]=$row;
		}
		return $product;
	}
	function getData($query, $index="name", $value="value"){
		$data = [];
		for ($i=0; $row=mysqli_fetch_array($query) ; $i++) {
			$data[$row[$index]]=$row[$value];
		}
		return $data;
	}
	function connection(){
		$this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db) or die("Error " . mysqli_error($this->errors));
	}
	function encryptIt( $q ) {
	    $cryptKey  = cryptKey;
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}

	function decryptIt( $q ) {
	    $cryptKey  = cryptKey;
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
}

?>