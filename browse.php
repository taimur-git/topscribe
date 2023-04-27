
<?php 
include('partial/navbar.php');
$str = "<div class='user-profile-view'>
    <h1>CONTESTS</h1>
<a class='btn btn-lg btn-primary' type='button' href='discover.php'>Host your Own Contest</a>
</div>";

$user = isset($_SESSION['id'])?$_SESSION['id']:-1;
if($user>0){
echo $str;
}
showAllContest($conn,$user);
?>

<?php include('partial/footer.php');?>