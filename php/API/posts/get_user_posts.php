<?php
    require '../database.php';

    // Variables and SQL statements
    $posts = [];
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE user_id={$id} ORDER BY posts.date DESC";

    // Get user IDs for every friend associated with given user id.
    if($result = mysqli_query($con,$sql)) {
        while($row = mysqli_fetch_assoc($result)){
            $posts[] = $row;
        }
        echo json_encode($posts);
    }
?>