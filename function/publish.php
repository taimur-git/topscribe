<?php
include('constant.php');

    $authorID = $_SESSION['id'];
    $title = $_POST['title'];
    $body= $_POST['body'];
	
    $writing_id = publishWriting($conn,$title,$body,$authorID);
    header("Location: ../index.php");
    //header("Location: ../index.php?id=$writing_id");
?>