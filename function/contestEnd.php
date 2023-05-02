<?php
include('constant.php');
$cid = $_GET['cid'];
$sql = "UPDATE `contest` SET `end` = CURRENT_TIMESTAMP-1 WHERE `contest`.`id` = '$cid' ";
mysqli_query($conn,$sql);
header("Location: ../browse.php");
?>