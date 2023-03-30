<?php
include('constant.php');
$user = $_SESSION['id'];
    $gid = $_GET['gid'];
    removeGroup($conn,$gid);
?>