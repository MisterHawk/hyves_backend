<?php
require '../database.php';

$profile = [];
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $_GET['id'];
$sql = "SELECT id, username, first_name, last_name, picture_url, user_bio FROM profile WHERE id = {$id}";

// Echo result for 1 profile
if($result = mysqli_query($con,$sql)) {
  $row = mysqli_fetch_assoc($result);

  $profile['id'] = $row['id'];
  $profile['username'] = $row['username'];
  $profile['first_name'] = $row['first_name'];
  $profile['last_name'] = $row['last_name'];
  $profile['picture_url'] = $row['picture_url'];
  $profile['user_bio'] = $row['user_bio'];

  echo json_encode($profile);
} else {
  http_response_code(404);
}
?>
