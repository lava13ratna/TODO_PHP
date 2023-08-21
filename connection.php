<?php 

$hostname = "localhost";
$username = 'root';
$password = '';
$dbname = 'todophp';

$con = mysqli_connect($hostname,$username,$password,$dbname);//procedural style
//$con= new mysqli($hostname,$username,$password,$dbname); //ovject oriented style

if(!$con){
    die("Connection failed : ".mysqli_connect_error());//procedural style
	//die("Connection failed : ".$con->connect_error);//object oriented style
}

?>