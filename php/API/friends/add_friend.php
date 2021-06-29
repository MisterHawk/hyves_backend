<?php
require '../database.php';

// Variables and SQL statements
$id = $_GET['id'];
$id2 = $_GET['id2'];
$sql = "SELECT id FROM friends WHERE id={$id} and id2={$id2} OR id={$id2} and id2={$id}";

// Get user IDs for every friend associated with given user id.
if($result = mysqli_query($con,$sql)) {
    if(mysqli_num_rows($result) == 0){
        $sql2 = "INSERT INTO `friends`(`id`,`id2`,`status`) VALUES ('{$id}', '{$id2}', 'pending')";
        if($result2 = mysqli_query($con, $sql2)){
            echo json_encode("Friend request sent");
        }
    } else {
        echo json_encode("Already friends or request still pending");
    }
}
?>