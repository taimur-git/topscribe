

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
        include('partial/searchBar.php');
        echo "<div id='touchThis'>";
        showAllWriting($conn);
        echo "</div>";
    }
}else{
    //landing page
    include('partial/landing.php');
}

include('partial/footer.php');?>
    



