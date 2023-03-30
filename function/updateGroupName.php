<?php
include('constant.php');
$gid = $_GET['gid'];
$groupname = $_GET['groupname'];
updateGroupName($conn,$gid,$groupname);
?>