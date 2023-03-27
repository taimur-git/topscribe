

<?php include('partial/navbar.php');?>

<!--landing page-->
<?php
//showAllWriting($conn);

if(isset($_SESSION['name'])) {
    //place here
    //user page
    showAllWriting($conn);
}else{
    //landing page
    include('partial/landing.php');
}
      include('partial/footer.php');?>
    



