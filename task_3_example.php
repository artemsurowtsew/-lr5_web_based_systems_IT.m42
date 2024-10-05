<?php 

class db { public $db; 

public function __construct() { 

echo "<h1>Connecting with database</h1>"; 

$this->db = new mysqli('localhost','root',''); 

if($this->db->connect_error) { 

throw new DbException("Connection error : "); 

} 

$this->db->query("SET NAMES 'UTF8'"); 

} public function get_data() { 

$query = "SELECT * from menu"; $result = $this->db->query($query); for($i = 0; $i < $result->num_rows; $i++) { 

$row[] = $result->fetch_assoc(); 

} 

return $row; 

} 

} 

$obj1 = new db(); 

$obj2 = new db(); 

$obj3 = new db(); 

?> 