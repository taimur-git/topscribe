<?php
include('constant.php');

    $host = $_SESSION['id'];
    $title = $_POST['title'];
    $description= $_POST['body'];
    $subcategory=$_POST['subcategory'];

    $bannerURL = $_POST['banner-url'];
    $start= $_POST['start-time'];
    $end=$_POST['deadline'];

    $capacity= $_POST['capacity'];
    $student= $_POST['student'];
    $judge=$_POST['judge'];

    if($judge==0){$judge=null;}
    if($student==0){$student=null;}
    if($capacity==0){$capacity=null;}
    if($bannerURL==""){$bannerURL="images/banner.png";}
	//createContest($conn, $title, $description,$host,$subcategoryID=19,$capacity=null,$start=null,$end=null,$judges=null,$classroom=null)
    $contest_id = createContest($conn,$title,$description,$host,$subcategory,$capacity,$start,$end,$judge,$student,$bannerURL);

    //if judge != null , 


    header("Location: ../browse.php");
    //header("Location: ../index.php?id=$writing_id");
?>