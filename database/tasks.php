<?php
session_start();
include_once '../database/connection.php';
include_once '../helpers/functions.php';
include_once '../helpers/validations.php';
$errors=[];
$task=sanitization($_POST['task']);
if(TaskLength($task,$errors) ){
$sql=$con->prepare("insert into tasks (task,user_id) values ('$task','{$_SESSION['auth']['id']}')");
$sql->execute();
header('location:../profile.php');
}
else{
  
  $_SESSION['errors']=$errors;
  header('location:../profile.php');
}
