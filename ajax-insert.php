<?php

$email = $_POST["email"];
$name = $_POST["name"];
$qualification = $_POST["qualification"];

$conn = mysqli_connect("localhost","root","","candidate") or die("Connection Failed");

$sql = "INSERT INTO  candidate_data (email, name, qualification) VALUES ('{$email}','{$name}','{$qualification}')";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}


?>
