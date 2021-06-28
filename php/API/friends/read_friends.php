<?php
require '../database.php';

// Variables and SQL statements
$profiles = [];
$id = $_GET['id'];
$sql = "SELECT * FROM profile WHERE profile.id IN (
        (SELECT id FROM friends WHERE id2 = {$id})
        UNION
        (SELECT id2 FROM friends WHERE id = {$id})
    )";

// Get user IDs for every friend associated with given user id.
if($result = mysqli_query($con,$sql)) {
    while($row = mysqli_fetch_assoc($result)){
        $profiles[] = $row;
    }
    echo json_encode($profiles);
}
?>