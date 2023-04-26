<?php
include('constant.php');
$cid = $_GET['cid'];
$user = $_SESSION['id'];
registerForContest($conn,$cid,$user);
header("Location: ../browse.php");


?>