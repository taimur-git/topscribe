

<?php include('partial/navbar.php');?>

<body>
<!--landing page-->
<form action="function/publish.php" method="post">

    <input type="text" class="borderless" name="title" placeholder='Write your title here' required>

    <textarea name='body'></textarea>
    <div class="d-grid gap-2">
<?php
    if(isset($_SESSION['name'])) {
        echo "<button class='btn btn-primary' type='submit' >Publish</button>
        <button class='btn btn-primary' type='submit' >Save as Draft</button>";
    }
?>
    </div>

</form>


<?php

?>

<script type="text/javascript" src="scripts/editor.js"></script>
</body>