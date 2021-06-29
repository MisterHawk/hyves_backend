<?php
require '../database.php';

// Variables and SQL statements
$friend_requests = [];
$id = $_GET['id'];
$reply = $_GET['reply'];

// Get user IDs for every friend associated with given user id.
if($reply === 1){
    $sql = "UPDATE friends SET status='accepted' WHERE id2={$id} and status='pending'";
    if($result = mysqli_query($con,$sql)) {
        echo json_encode("Friend added");
    }
} else {
    $sql = "DELETE FROM friends WHERE id2={$id} and status='pending'";
    if($result = mysqli_query($con,$sql)) {
        echo json_encode("Friend declined");
    }
}

?>