<?php
require '../database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

// Check posted data
if(isset($postdata) && !empty($postdata)) {
  $request = json_decode($postdata);
  
  $email = mysqli_real_escape_string($con, $request->email);
  $first_name = mysqli_real_escape_string($con, $request->first_name);
  $last_name = mysqli_real_escape_string($con, $request->last_name);
  $picture_url = mysqli_real_escape_string($con, trim($request->picture_url));
  $user_bio = mysqli_real_escape_string($con, $request->user_bio);

  $sql = "INSERT INTO `profile`(`emaile`,`first_name`,`last_name`,`picture_url`,`user_bio`) VALUES ('{$email}','{$first_name}','{$last_name}','{$picture_url}','{$user_bio}')";

  if(mysqli_query($con,$sql)) {
    http_response_code(201);
    $profile = [
      'email' => $email,
      'first_name' => $first_name,
      'last_name' => $last_name,
      'picture_url' => $picture_url,
      'user_bio' => $profile
    ];
    echo json_encode($profile);
  } else {
    http_response_code(422);
  }
}