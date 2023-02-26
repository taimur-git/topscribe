<?php
    include('constant.php');
    $uname = $_GET['uname'];
    $sql = "SELECT * FROM usernames WHERE username='$uname'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) !== 0) {
        echo 1;
    }else{
        echo 0;
    }
?>