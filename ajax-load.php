<?php

$conn = mysqli_connect("localhost","root","","candidate") or die("Connection Failed");

$sql = "SELECT * FROM   candidate_data";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
  $output = '<table>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Name</th>
          <th>Qualification</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>';

              while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr>
                <td><a href='#'>{$row["id"]}</a></td>
                <td>{$row["email"]} </td>
                <td>{$row["name"]} </td>
                <td>{$row["qualification"]} </td>
                <td class='text-center edit edit-btn' data-eid='{$row["id"]}'><p><i class='fas fa-user-edit'></i></p> </td>
                <td class='text-center delete delete-btn'  data-id='{$row["id"]}'><p> <i class='far fa-trash-alt'></i></p></td>
               </tr>";
              }
    $output .= "</table>";

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}
?>