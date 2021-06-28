<?php
  require '../database.php';

  $post = [];
  $id = $_GET['post_id'];
  $sql = "SELECT user_id, image_url, content, date FROM posts WHERE post_id = {$id}";

  // Echo result for 1 profile
  if($result = mysqli_query($con,$sql)) {
    $row = mysqli_fetch_assoc($result);

    $post['user_id'] = $row['user_id'];
    $post['image_url'] = $row['image_url'];
    $post['content'] = $row['content'];
    $post['date'] = $row['date'];

    echo json_encode($post);
  } else {
    http_response_code(404);
  }
?>