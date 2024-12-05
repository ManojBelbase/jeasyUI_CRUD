<?php
$hostname="localhost";
$username="root";
$password="";
$database="jeasyui";

$conn= new mysqli($hostname,$username,$password,$database);
if($conn->connect_error){
die('Error connecting db');
}
?>