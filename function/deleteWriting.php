<?php
include('constant.php');
    $writingid = $_GET['writeid'];
    deleteWriting($conn,$writingid);
    header("Location:../index.php");
?>