<?php
  require '../database.php';

  $profile = [];
  $id = $_GET['id'];
  $sql = "SELECT id, username, first_name, last_name, picture_url, user_bio FROM profile WHERE id = {$id}";

  // Echo result for 1 profile
  if($result = mysqli_query($con,$sql)) {
    $row = mysqli_fetch_assoc($result);
    $profile = $row;
    echo json_encode($profile);
  } else {
    http_response_code(404);
  }
?>
