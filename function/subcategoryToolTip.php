<?php
include('constant.php');
    $subid = $_GET['subid'];
    $description = returnDescriptionSubCategory($conn,$subid);
    echo $description;
?>