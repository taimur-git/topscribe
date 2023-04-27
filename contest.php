<?php
include('partial/navbar.php');
?>

<?php
$id = $_GET['id'];
$user = isset($_SESSION['id'])?$_SESSION['id']:-1;

//show title, description of contest.
$obj = new Contest();
$obj->getInfoByID($id,$conn);
include('partial/contestView.php');

?>
<?php include('partial/footer.php');?>
