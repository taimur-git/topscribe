<?php
include('constant.php');

    $host = $_SESSION['id'];
    $title = $_POST['title'];
    $description= $_POST['body'];
//    $subcategory=$_POST['subcategory'];
	//createContest($conn, $title, $description,$host,$subcategoryID=19,$capacity=null,$start=null,$end=null,$judges=null,$classroom=null)
    $contest_id = createContest($conn,$title,$description,$host);
    header("Location: ../browse.php");
    //header("Location: ../index.php?id=$writing_id");
?>