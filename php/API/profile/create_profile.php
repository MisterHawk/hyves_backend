<?php
require '../database.php';

$profile = [];
// Check posted data
if(isset($_POST['email'])) {

  $email = $_POST['email'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $user_bio = $_POST['user_bio'];
  $image_url = 'http://localhost:8080/hyves_images/profile_pictures/hyves_clown.jpeg';
  if(!empty($_FILES['image'])){
      $image = $_FILES['image'];

      $fileName = $_FILES['image']['name'];
      $fileTmpName = $_FILES['image']['tmp_name'];
      $fileSize = $_FILES['image']['size'];
      $fileError = $_FILES['image']['error'];
      $fileType = $_FILES['image']['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('jpg','jpeg','png','pdf');

      if(in_array($fileActualExt, $allowed)){
          if($fileError === 0){
              if($fileSize < 500000) {
                  $fileNameNew = uniqid('',true).'.'.$user_id.'.'.$fileActualExt;
                  $fileDestination = '../../../../hyves_images/profile_pictures/'.$fileNameNew;
                  move_uploaded_file($fileTmpName, $fileDestination);
                  $image_url = 'http://localhost:8080/hyves_images/profile_pictures/'.$fileNameNew;
              }
          }
      }
  }

  $sql = "INSERT INTO `profiles`(`email`,`first_name`,`last_name`,`picture_url`,`user_bio`) 
          VALUES ('{$email}','{$first_name}','{$last_name}','{$image_url},'{$user_bio}'')";

  if(mysqli_query($con,$sql)) {
    http_response_code(201);
    $profile = [
      'email' => $email,
      'first_name' => $first_name,
      'last_name' => $content,
      'picture_url' => $image_url,
      'user_biuo' => $user_bio
    ];
    echo json_encode($profile);
  } else {
    http_response_code(422);
  }
}
?>