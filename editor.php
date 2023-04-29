

<?php include('partial/navbar.php');
$contestFlag = isset($_GET['cid']);
if($contestFlag){
    $contestID = $_GET['cid'];
    echo "<form action='function/enterContestEntry.php' method='post'><input type='hidden' id='contest-id' name='cid' value='$contestID'>";
}else{
    echo "<form action='function/publish.php' method='post'>";
}
$guestFlag = !isset($_SESSION['name']);



//echo "<form action='function/publish.php' method='post'>";
?>
    <input type="text" class="borderless" name="title" placeholder='Write your title here' required>
    <?php
    if($contestFlag){
        //fixed category
        //grab tool tip instantly as well.
        //$description = returnDescriptionSubCategory($conn,1);
        $row = getSubCategoryFromContest($conn,$contestID);
        $subcat = $row['subcategoryID'];
        $subname = $row['name'];
        $description = $row['helpstr'];
        echo "<input name='subcategory' type='hidden' value='$subcat'>";
        echo "<label for='category-select'>Category: <input type=text readonly id='contest-category' value='$subname'></label>";
        echo "<button type='button' id='subcategory-help2' class='cleanbutton' aria-describedby='tooltip'><i class='fa-solid fa-question'></i></button>";
        echo "<div id='tooltip' role='tooltip'>$description<div id='arrow' data-popper-arrow></div></div>";
    }else{
        createCategorySelect($conn);
        echo "<button type='button' id='subcategory-help' class='cleanbutton' aria-describedby='tooltip'><i class='fa-solid fa-question'></i></button>";
        echo "<div id='tooltip' role='tooltip'><div id='arrow' data-popper-arrow></div></div>";
    }
    
    ?>
    
    
    <div id="editor-body">
        <textarea name='body' id='simplemde'></textarea>
    </div>

<?php
createTopicInput($contestFlag,$guestFlag);
?>

    <div class="d-grid gap-2">
<?php
    if(!$guestFlag) {
        //place here 	//0 - publish 1 - anonymous 2 - hidden 3 - draft
        echo "<input type='hidden' id='hidetopic' name='topics' value=''>";
        if($contestFlag){
            echo "<button class='btn btn-primary' onclick='generateTopics()' type='submit' >Submit Contest Entry</button>";
        }else{
            echo "<button class='btn btn-primary' onclick='generateTopics()' type='submit' >Publish</button>";
        }
        
    }
?>
    </div>

</form>

<?php include('partial/footer.php');?>
<script type="text/javascript" src="scripts/editor.js"></script>