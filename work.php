<?php
include('partial/navbar.php');
$id = $_GET['id'];
incrementView($conn,$id);
//render the page
displayWriting($conn,$id);
?>