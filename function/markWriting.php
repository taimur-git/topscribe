<?php
include('constant.php');

    $judgeID = $_SESSION['id'];
    $mark = $_POST['marks'];
    $writingID= $_POST['wid'];
    $contest_id = $_POST['cid'];

    $sql = "INSERT INTO `marks` (`writingID`, `judgeID`, `score`) VALUES ('$writingID', '$judgeID', '$mark')";
    mysqli_query($conn,$sql);
    header("Location: ../contest.php?id=$contest_id");
?>