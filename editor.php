

<?php include('partial/navbar.php');?>

<body>
<!--landing page-->
<form action="function/publish.php" method="post">

    <input type="text" class="borderless" name="title" placeholder='Write your title here' required>
    <?php
    createCategorySelect($conn);
    //$description = returnDescriptionSubCategory($conn,1);
    //echo "<button type='button' id='subcategory-help' class='cleanbutton' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='$description'><i class='fa-solid fa-question'></i></button>";
    ?>
    <button type='button' id='subcategory-help' class='cleanbutton' aria-describedby="tooltip"><i class='fa-solid fa-question'></i></button>
    <div id='tooltip' role='tooltip'><div id="arrow" data-popper-arrow></div></div>
    <textarea name='body' id='simplemde'></textarea>


<?php


createTopicInput();
?>



    <div class="d-grid gap-2">
<?php
    if(isset($_SESSION['name'])) {
        //place here
        echo "<button class='btn btn-primary' type='submit' >Publish</button>
        <button class='btn btn-primary' type='submit' >Save as Draft</button>";
    }
?>
    </div>

</form>
<?php

?>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script type="text/javascript" src="scripts/editor.js"></script>
<?php include('partial/footer.php');?>