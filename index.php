

<?php include('partial/navbar.php');?>

<!--landing page-->
<?php
//showAllWriting($conn);

if(isset($_SESSION['name'])) {
    if($_SESSION['id']==0){
        //admin
        include('admin/home.php');
    }else{
        //place here
    //user page
        showAllWriting($conn);
    }
}else{
    //landing page
    include('partial/landing.php');
}
      include('partial/footer.php');?>
    



