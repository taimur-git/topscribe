<?php
include('partial/navbar.php');
?>

<?php
$id = $_GET['id'];
$user = isset($_SESSION['id'])?$_SESSION['id']:null;


?>
<?php include('partial/footer.php');?>
