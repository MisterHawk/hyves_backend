<?php
require '../database.php';

// Variables and SQL statements
$friend_requests = [];
$id = $_GET['id'];
$sql = "SELECT * FROM friends WHERE id2={$id} and status='pending'";

// Get user IDs for every friend associated with given user id.
if($result = mysqli_query($con,$sql)) {
    while($row = mysqli_fetch_assoc($result)){
        $friend_requests = $row;
    }
    echo json_encode($friend_requests);
}
?>