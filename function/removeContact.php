<?php
include('constant.php');
$user1 = $_SESSION['id'];
$user2 = $_GET['writer'];
removeContact($conn,$user1,$user2);
?>