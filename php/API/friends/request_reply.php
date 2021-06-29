<?php
require '../database.php';

// Variables and SQL statements
$friend_requests = [];
$id = $_POST['id'];
$id2 = $_POST['id2'];
$reply = $_POST['reply'];

// Get user IDs for every friend associated with given user id.
if($reply == 1){
    $sql = "UPDATE friends SET status='accepted' WHERE id={$id2} and id2={$id}";
    if($result = mysqli_query($con,$sql)) {
        echo json_encode("Friend added");
    }
} else {
    $sql = "DELETE FROM friends WHERE id={$id2} and id2={$id}";
    if($result = mysqli_query($con,$sql)) {
        echo json_encode("Friend declined");
    }
}

?>