<?php

$candiadateId = $_POST["id"];

$conn = mysqli_connect("localhost","root","","candidate") or die("Connection Failed");

$sql = "SELECT * FROM candidate_data WHERE id = {$candiadateId}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
        <tr>
        <td>ID</td>
        <td><input type='text' id='edit-id' readonly  value='{$row["id"]}'></td>
      </tr>
      <td width='90px'>Email</td>
      <td><input type='text' id='edit-email' value='{$row["email"]}'>
      </td>
    </tr>
    <tr>
      <td>Name</td>
      <td><input type='text' id='edit-name' value='{$row["name"]}'></td>
    </tr>
    <tr>
    <td>Qualification</td>
    <td><input type='text' id='edit-qualification' value='{$row["qualification"]}'></td>
  </tr>
    <tr>
      <td></td>
      <td><input type='submit' class='btn btn-outline-success px-5' id='edit-submit' value='Save'></td>
    </tr>";

  }

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
