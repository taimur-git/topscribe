<?php
session_start();
include('constant.php');

if(isset($_POST['username']) && isset($_POST['password'])){

    $uname = validate($_POST['username']);
	$pass = validate($_POST['password']);

    $sql = "SELECT * FROM usernames WHERE username='$uname' ";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass,$row['password'])) {
            $_SESSION['name'] = $row['username'];
            $_SESSION['id'] = $row['id'];
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