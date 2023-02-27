<?php
include('partial/navbar.php');
$id = $_GET['id'];
//render the page
displayWriting($conn,$id);
?>