<?php
  require '../database.php';

  $postdata = file_get_contents("php://input");
  $post = [];

  if(isset($_POST['submit'])) {
    $request = json_decode($postdata);
    
    // $user_id = 'mysqli_real_escape_string($con, $request->user_id)';
    // $content = 'mysqli_real_escape_string($con, $request->content)';

    $user_id = $_POST['user_id'];
    $content = $_POST['content'];
    $image_url = null;
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
                    $fileDestination = '../../../../hyves_images/post_pictures/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $image_url = 'http://localhost:8080/hyves_images/post_pictures/'.$fileNameNew;
                }
            }
        }
    }
  
    $sql = "INSERT INTO `posts`(`user_id`,`image_url`,`content`) VALUES ('{$user_id}','{$image_url}','{$content}')";
  
    if(mysqli_query($con,$sql)) {
      http_response_code(201);
      $post = [
        'user_id' => $user_id,
        'image_url' => $image_url,
        'content' => $content
      ];
      echo json_encode($post);
    } else {
      http_response_code(422);
    }
  }
?>