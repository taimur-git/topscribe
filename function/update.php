<?php
include('constant.php');
//$authorID = $_SESSION['id'];
$title = $_POST['title'];
$body= $_POST['body'];
$subcategory = $_POST['subcategory'];
$id = $_POST['darkid'];
//$topics = $_POST['topics'];
$privacy = $_POST['audience'];
$sql = "UPDATE `writing` SET 
`body` = '$body', 
title='$title', 
subcategoryID='$subcategory',
status='$privacy' 
WHERE `writing`.`id` = '$id'";
mysqli_query($conn,$sql);
header("Location: ../work.php?id=$id");
?>