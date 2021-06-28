<?php
  require '../database.php';

  $posts = [];
  $id = $_GET['post_id'];
  $sql = "SELECT * FROM post WHERE profile.id IN (
            (SELECT id FROM friends WHERE id2 = {$id})
            UNION
            (SELECT id2 FROM friends WHERE id = {$id})
        ) LIMIT 100";

  // Echo result for 1 profile
  if($result = mysqli_query($con,$sql)) {
    while($row = mysqli_fetch_assoc($result)){
        $posts = $row;
    }
    echo json_encode($posts);
  } else {
    http_response_code(404);
  }
?>
