<?php
include('partial/navbar.php');
?>

<?php
$id = $_GET['id'];
$obj = new Writing();
        $obj->generate3($id,$conn);
        $title = $obj->title;
        $body = $obj->body;
        $subid = $obj->subcategory;
//getWritingInfo($conn,$id);

?>

<form action="function/update.php" method="post">
    <input type="text" class="borderless" name="title" placeholder='Write your title here' value='<?php echo $title;?>' required>
    <?php
    createCategorySelect($conn,$subid);
    ?>
    <button type='button' id='subcategory-help' class='cleanbutton' aria-describedby="tooltip"><i class='fa-solid fa-question'></i></button>
    <div id='tooltip' role='tooltip'><div id="arrow" data-popper-arrow></div></div>
    <textarea name='body' id='simplemde'><?php echo $body?></textarea>
<?php
createTopicInput();
$something = "";
//createTopicFromID($conn,$id);
    echo "<div class=d-grid gap-2>";
        //place here 	//0 - publish 1 - anonymous 2 - hidden 3 - draft
        //get value from topics, and then use javascript to show it on the topicinput area.
        echo "<input type='hidden' id='hidetopic' name='topics' value='$something'>";
        echo "<input type='hidden' name='darkid' value='$id'>";
        echo "<button class='btn btn-primary' onclick='updateTopics()' type='submit' >Update</button>";
?>
    </div>

</form>





<?php include('partial/footer.php');?>
<script type="text/javascript" src="scripts/editor.js"></script>