<?php

$candidateId = $_POST["id"];

$conn = mysqli_connect("localhost","root","","candidate") or die("Connection Failed");

$sql = "DELETE FROM candidate_data  WHERE id = {$candidateId}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
