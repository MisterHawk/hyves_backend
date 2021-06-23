<?php
require '../database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

// Check posted data
if(isset($postdata) && !empty($postdata)) {
  $request = json_decode($postdata);

  $id = mysqli_real_escape_string($con, trim($request->id));
  $username = mysqli_real_escape_string($con, $request->username);
  $first_name = mysqli_real_escape_string($con, $request->first_name);
  $last_name = mysqli_real_escape_string($con, $request->last_name);
  $picture_url = mysqli_real_escape_string($con, trim($request->picture_url));
  $user_bio = mysqli_real_escape_string($con, $request->user_bio);

  $sql = "INSERT INTO `profile`(`id`,`username`,`first_name`,`last_name`,`picture_url`,`user_bio`) VALUES ('{$id}','{$username}','{$first_name}','{$last_name}','{$picture_url}','{$user_bio}')";

  if(mysqli_query($con,$sql)) {
    http_response_code(201);
    $profile = [
      'id' => $id,
      'username' => $username,
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