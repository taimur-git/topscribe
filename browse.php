
<?php include('partial/navbar.php');?>

<!--landing page-->
<?php
//$id = $_GET['id'];
$user = isset($_SESSION['id'])?$_SESSION['id']:0;
showAllContest($conn,$user);
?>

<?php include('partial/footer.php');?>