

<?php include('partial/navbar.php');?>

<!--landing page-->
<?php
//showAllWriting($conn);

if(isset($_SESSION['name'])) {
    if($_SESSION['id']==0){
        //admin
        include('admin/home.php');
    }else{
        include('partial/writings.php');
        $flag = true;
        
    }
}else{
    //landing page
    include('partial/landing.php');
}

include('partial/footer.php');
if(isset($flag)){
    echo "<script type='text/javascript' src='scripts/writings.js'></script>";
}
?>
    



