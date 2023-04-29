<?php
include('constant.php');

    $judgeID = $_SESSION['id'];
    $mark = $_POST['marks'];
    $writingID= $_POST['wid'];
    $contest_id = $_POST['cid'];
    $feedback = $_POST['feedback'];

//if marks already exists, update it instead.
$sql = "select * from marks where writingID='$writingID' and judgeID='$judgeID'";
$res = mysqli_query($conn,$sql);
if(mysqli_num_rows($res)==0){
    $sql = "INSERT INTO `marks` (`writingID`, `judgeID`, `score`, `feedback`) VALUES ('$writingID', '$judgeID', '$mark', '$feedback')";
}else{
    $sql = "UPDATE `marks` SET `score` = '$mark', `feedback` = '$feedback' WHERE `marks`.`writingID` = '$writingID' AND `marks`.`judgeID` = '$judgeID' ";
}
    
    
    mysqli_query($conn,$sql);
    header("Location: ../contest.php?id=$contest_id");
?>