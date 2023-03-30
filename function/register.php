<?php
include('constant.php');

    $uname = validate($_POST['username']);
	$pass = validate($_POST['password']);
    $c_pass= validate($_POST['c_password']);
    $imgurl = $_POST['imgurl'];
    if($imgurl==null){$imgurl="images/blank.jpg";}
    if($pass !== $c_pass){
        header("Location: ../registration.php?error=Password is not same");
	    exit();
    
    }
    else {
        $sql = "SELECT * FROM usernames WHERE username='$uname'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) !== 0) {
            header("Location: ../registration.php?error=Account already exists");
            exit();
        }
        else{
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO usernames (username,password,photo) VALUE ('$uname','$hash','$imgurl')";
                mysqli_query($conn, $sql);
                session_unset();
                session_destroy();
                //$_SESSION['name'] = $uname;
                header("Location:../index.php");
    
        }    
       }


?>