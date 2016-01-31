<?php


//SESSION
session_start();


//VARs
$action = isset($_GET['action']) ? $_GET['action'] : false;
$page = isset($_GET['page']) ? $_GET['page'] : false;
$id = isset($_GET['id']) ? $_GET['id'] : false;

//DB
$sql = new mysqli("localhost","blog","","blog");

if($sql->connect_error) 
	die('Could not connect to DB. Error ' . $sql->connect_errno . ': ' . $sql->connect_error);

function throw_error($reason) {
	echo '<div class="alert alert-danger" role="alert">'.$reason.'</div>';
}

?>