<?php
include('function/constant.php');

$id = validate($_GET['id']);
$sql_dt = "DELETE FROM usernames WHERE id='$id' ";
$res = mysqli_query($conn, $sql_dt);

if ($res) {
    echo "<script>alert('Record Deleted from Database')</script>";
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL=
    http://localhost/topscribe/admin_user.php">
    <?php

}


?>