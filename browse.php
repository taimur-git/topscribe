
<?php include('partial/navbar.php');
if(isset($_SESSION['id'])){?>
<div class="user-profile-view">
    <h1>CONTESTS</h1>
<a class="btn btn-lg btn-primary" type="button" href="discover.php">Host your Own Contest</a>
</div>
<!--landing page-->
<?php
}
//$id = $_GET['id'];
$user = isset($_SESSION['id'])?$_SESSION['id']:-1;
showAllContest($conn,$user);
?>

<?php include('partial/footer.php');?>