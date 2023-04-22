<?php
include('function/constant.php');
include('admin/constant.php');

$id = validate($_GET['id']);

$res = deleteSubCategory($conn,$id);
if ($res) {
    echo "<script>alert('Record Deleted from Database')</script>";

}
else{
    echo "<script>alert('This is a Default Sub-Category')</script>";

}
?>
<META HTTP-EQUIV="Refresh" CONTENT ="0; URL=
http://localhost/topscribe/admin_catagory.php">


