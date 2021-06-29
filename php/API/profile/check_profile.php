<?php
  require '../database.php';

  $id = [];
  $email = $_GET['email'];
  $sql = "SELECT id FROM profile WHERE email = '{$email}'";

  if($result = mysqli_query($con,$sql)) {
    $row = mysqli_fetch_assoc($result);
    $id = $row;
    echo json_encode($id);
  } else {
    http_response_code(422);
  }
?>