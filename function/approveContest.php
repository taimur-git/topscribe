<?php
include('constant.php');
include('../admin/constant.php');
$id = $_GET['id'];
$cid = $_GET['cid'];
switch($id){
    case 1:
        approveContest($conn,$cid);
        break;
    case 2:
        approveFuture($conn,$cid);
        break;
    case 3:
        approveAllForUser($conn,$cid);
        break;
    default:
        
}
header("Location:../browse.php");

?>