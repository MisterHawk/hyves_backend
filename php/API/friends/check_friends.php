<?php
require '../database.php';

// Variables and SQL statements
$friends = [];
$id = $_GET['id'];
$id2 = $_GET['id2'];
$sql = "SELECT * FROM friends WHERE id={$id} and id2={$id2} OR id={$id2} and id2={$id}";

// Get user IDs for every friend associated with given user id.
if($result = mysqli_query($con,$sql)) {
    $row = mysqli_fetch_assoc($result);
    $friends = $row;
    if($friends['status'] == 'accepted'){
        echo json_encode("Friends");
    } elseif($friends['status'] == 'pending') {
        echo json_encode("Friend request pending");
    } elseif (empty($friends)) {
        echo json_encode("Not friends");
    }
}
?>