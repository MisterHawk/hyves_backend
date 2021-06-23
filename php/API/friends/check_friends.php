<?php
require '../database.php';

// Variables and SQL statements
$friend_ids = [];
$profiles = [];
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $_GET['id'];
$sql = "SELECT * FROM profile WHERE profile.id IN (
        (SELECT id FROM friends WHERE id2 = {$id})
        UNION
        (SELECT id2 FROM friends WHERE id = {$id})
    )";

// Get user IDs for every friend associated with given user id.
if($result = mysqli_query($con,$sql)) {
    while($row = mysqli_fetch_assoc($result)){
        $friend_ids[] = $row;
    }
    echo json_encode($friend_ids);
}
?>