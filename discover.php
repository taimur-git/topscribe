

<?php include('partial/navbar.php');?>

<!--landing page-->
<form action="function/postContest.php" method="post">

    <input type="text" class="borderless" name="title" placeholder='Write your contest title here' required>

    <textarea name='body'></textarea>
    <div class="d-grid gap-2">
        
<?php

/*have a select bar for the category*/
    if(isset($_SESSION['name'])) {
        echo "<button class='btn btn-primary' type='submit' >Post Contest</button>";
    }
?>
    </div>

</form>


<?php

?>

<?php include('partial/footer.php');?>