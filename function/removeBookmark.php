<?php
include('constant.php');

    $user = $_SESSION['id'];
    $writingid = $_GET['writeid'];

    removeBookmark($conn,$user,$writingid);
?>