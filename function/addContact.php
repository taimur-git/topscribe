<?php
include('constant.php');

$user1 = $_SESSION['id'];
$user2 = $_GET['writer'];

//addBookmark($conn,$user,$writingid);
addContact($conn,$user1,$user2);
?>