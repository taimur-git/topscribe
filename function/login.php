<?php
session_start();
include('constant.php');

if(isset($_POST['username']) && isset($_POST['password'])){

    $uname = validate($_POST['username']);
	$pass = validate($_POST['password']);

    $sql = "SELECT * FROM user WHERE login='$uname' ";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass,$row['pass'])) {
            $_SESSION['name'] = $row['login'];
            header("Location: ../index.php");
		    exit();
        }else{
            header("Location: ../index.php?error=Incorrect Password");
            exit();
            }
        }
    else{
        header("Location: ../index.php?error=Username does not exist");
        exit();
    }
}