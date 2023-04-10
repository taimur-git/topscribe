<?php include('partial/navbar.php');?>
<?php
$user = $_SESSION['id'];
$page = $_GET['id'];

if($user == $page){
    //if user goes to their own page:
    
}else{
    //any other user's page.
    //see their profile, add them, and see all their writings and hosted contests.
    renderUserPage($conn,$page,$user);
}
?>
<?php include('partial/footer.php');?>