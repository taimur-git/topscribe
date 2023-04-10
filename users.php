

<?php include('partial/navbar.php');?>

<!--landing page-->
<?php
//showAllWriting($conn);

if(isset($_SESSION['name'])) {
    $user = $_SESSION['id'];
    showAllUsers($conn,$user);
    
}else{
    showAllUsers($conn);
    //landing page
    //include('partial/landing.php');
}
      include('partial/footer.php');?>
    



