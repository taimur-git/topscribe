<?php
include('constant.php');
$user = $_SESSION['id'];
    $groupname = $_GET['groupname'];
    addGroup($conn,$groupname,$user);
?>