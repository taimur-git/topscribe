<?php
include('constant.php');
$cid = $_GET['cid'];
$user = $_SESSION['id'];
//registerForContest($conn,$cid,$user);

$sql = "DELETE FROM contestusers WHERE `contestusers`.`contestID` = '$cid' AND `contestusers`.`writerID` = '$user'";
mysqli_query($conn,$sql);
header("Location: ../browse.php");
?>