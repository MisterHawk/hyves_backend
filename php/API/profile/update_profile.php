<?php
require '../database.php';

// Get the posted data.
if(isset($_POST['id'])) {
  $id = $_POST['id'];
  if(isset($_POST['first_name']) && !empty($_POST['first_name'])) {
    $first_name = $_POST['first_name'];
    $sql = "UPDATE `profile` SET `first_name`='{$first_name}' WHERE id={$id}";
    if(mysqli_query($con,$sql)) {
      http_response_code(201);
      echo json_encode("First name updated");
    } else {
      http_response_code(422);
    }
  }

  if(isset($_POST['last_name']) && !empty($_POST['last_name'])) {
    $last_name = $_POST['last_name'];
    $sql = "UPDATE `profile` SET `last_name`='{$last_name}' WHERE id={$id}";
    if(mysqli_query($con,$sql)) {
      http_response_code(201);
      echo json_encode("Last name updated");
    } else {
      http_response_code(422);
    }
  }

  if(isset($_POST['gender']) && !empty($_POST['gender'])) {
    $gender = $_POST['gender'];
    $sql = "UPDATE `profile` SET `gender`='{$gender}' WHERE id={$id}";
    if(mysqli_query($con,$sql)) {
      http_response_code(201);
      echo json_encode("Gender updated");
    } else {
      http_response_code(422);
    }
  }

  if(isset($_POST['user_bio']) && !empty($_POST['user_bio'])){
    $user_bio = $_POST['user_bio'];
    $sql = "UPDATE `profile` SET `user_bio`='{$user_bio}' WHERE id={$id}";
    if(mysqli_query($con,$sql)) {
      http_response_code(201);
      echo json_encode("User bio updated");
    } else {
      http_response_code(422);
    }
  }

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
                $fileNameNew = uniqid('',true).'.'.$fileActualExt;
                $fileDestination = '../../../../hyves_images/profile_pictures/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $image_url = 'http://127.0.0.1:8080/hyves_images/profile_pictures/'.$fileNameNew;
                $sql = "UPDATE `profile` SET `picture_url`='{$image_url}' WHERE id={$id}";
                if(mysqli_query($con,$sql)) {
                  http_response_code(201);
                  echo json_encode("Profile picture updated");
                } else {
                  http_response_code(422);
                }
            }
        }
    }
  }
}
