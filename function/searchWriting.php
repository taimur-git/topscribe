<?php
include('constant.php');
    $search = $_GET['search'];
    $order =  $_GET['order'];
    $sort = $_GET['sort'];
    //$description = returnDescriptionSubCategory($conn,$subid);
    //echo $description;
    //function showAllWriting($conn, $case=0,$user=0,$search='',$order=0,$asc=1,$top=0,$echoFlag=true){
    showAllWriting($conn, 0,0,$search,$order,$sort);
?>