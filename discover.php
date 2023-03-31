<?php 
include('partial/navbar.php');
$user = $_SESSION['id'];
?>

<form action="function/postContest.php" method="post">

<div>
<input type="text" class="borderless" name="title" placeholder='Write your contest title here' required>

<?php
//<select name='subcategory' id='category-select' onchange='changeTooltip()'>
    createCategorySelect($conn);
    ?>
    <button type='button' id='subcategory-help' class='cleanbutton' aria-describedby="tooltip"><i class='fa-solid fa-question'></i></button>
    <div id='tooltip' role='tooltip'><div id="arrow" data-popper-arrow></div></div>

    <div id="editor-body" class='contest-editor-body'>
        <textarea name='body' id='simplemde'></textarea>
    </div>
    <div id='contest-inputs'>
       <?php
       //banner should be 5:14
       renderContestEditorBanner();
       createGroupSelect($conn,$user,false);
       echo "<br>";
       createGroupSelect($conn,$user,true);
       echo "<br>";
    if(isset($_SESSION['name'])) {
        echo "<button class='btn btn-primary' type='submit' >Post Contest</button>";
    }
?>
    
</form>
</div>
</div>
<?php

?>

<?php include('partial/footer.php');?>
<script type="text/javascript" src="scripts/contestEditor.js"></script>