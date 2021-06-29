<?php
require '../database.php';

// Variables and SQL statements
$id = $_GET['id'];
$id2 = $_GET['id2'];
$sql = "SELECT id FROM friends WHERE id={$id} and id2={$id2} OR id={$id2} and id2={$id}";

// Get user IDs for every friend associated with given user id.
if($result = mysqli_query($con,$sql)) {
    if(mysqli_num_rows($result) > 0){
        $sql2 = "DELETE FROM `friends` WHERE id={$id} and id2={$id2} OR id={$id2} and id2={$id}";
        if($result2 = mysqli_query($con, $sql2)){
            echo json_encode("Friend removed");
        }
    } else {
        echo json_encode("No relationship found between members");
    }
}
?>