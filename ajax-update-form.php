<?php

$cand_id = $_POST["id"];
$cand_email = $_POST["email"];
$cand_name= $_POST["name"];
$cand_qualification= $_POST["qualification"];

$conn = mysqli_connect("localhost","root","","candidate") or die("Connection Failed");

$sql = "UPDATE candidate_data SET email = '{$cand_email}',name = '{$cand_name}',qualification = '{$cand_qualification}'  WHERE id = {$cand_id}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>