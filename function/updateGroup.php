<?php
include('constant.php');
$str = $_GET['garray'];
$garray = json_decode($str);
    $gid = $_GET['gid'];
addContactsToGroup($conn,$gid,$garray);
?>