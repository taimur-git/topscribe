<?php
include('constant.php');
include('../admin/constant.php');
$cid = $_GET['cid'];
deleteContest($conn,$cid);
header("Location:../browse.php");
?>