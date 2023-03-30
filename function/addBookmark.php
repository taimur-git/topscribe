<?php
include('constant.php');
    $user = $_SESSION['id'];
    $writingid = $_GET['writeid'];
    addBookmark($conn,$user,$writingid);
?>