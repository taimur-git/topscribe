

<?php include('partial/navbar.php');?>

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
    <div id="editor-body">
        <textarea name='body' id='simplemde'></textarea>
    </div>

<?php


createTopicInput();
?>



    <div class="d-grid gap-2">
<?php
    if(isset($_SESSION['name'])) {
        //place here 	//0 - publish 1 - anonymous 2 - hidden 3 - draft
        
        echo "<input type='hidden' id='hidetopic' name='topics' value=''>";
         
        echo "<button class='btn btn-primary' onclick='generateTopics()' type='submit' >Publish</button>";
    }
?>
    </div>

</form>

<?php
//<button onclick='test()'>test</button>
?>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script type="text/javascript" src="scripts/editor.js"></script>
<?php include('partial/footer.php');?>