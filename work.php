<?php
include('partial/navbar.php');
?>
<link rel="stylesheet" href="css/work.css">

<?php
$id = $_GET['id'];
$user = isset($_SESSION['id'])?$_SESSION['id']:-1;

incrementView($conn,$id);
//render the page
displayWriting($conn,$id);
echo "<div class='profilebar'>";
$writer = profileView($conn,$id);
if($user!=-1){
    
    $flag = ifBookmark($conn,$user,$id);
    $flag2 = isContestEntry($conn,$id);
    $bookmark = "<button onclick='toggleBookmark($id)' class=cleanbutton><i class='fa-";
    $bookmark.= $flag ? "solid" : "regular";
    $bookmark.= " fa-bookmark' id='bookmark'></i></button>";
    echo $bookmark;
    if($writer == $user){
        
        //echo "<button class='cleanbutton disabled' href='edit?id=$id'><i class='fa-solid fa-pen-to-square'></i></button>";
        echo $flag2?"":"<button onclick='deleteWriting($id)' class=cleanbutton><i class='fa-solid fa-trash'></i></button>";
    }else{
        $added = returnIfAdded($conn,$writer,$user);
        echo $added?
        "<button class=cleanbutton onclick='removeContact($writer)'><i class='fa-solid fa-user-minus'></i></button>"
        :"<button class=cleanbutton onclick='addContact($writer)'><i class='fa-solid fa-user-plus'></i></button>";
    }
    
}
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "<button type='button' class=cleanbutton data-bs-container='body' data-bs-toggle='popover'
data-bs-placement='bottom' data-bs-content='$url' onclick='copyToClipboard()'>
<i class='fa-solid fa-link'></i>
</button>";
//echo "<a type='button' class=cleanbutton href='function/downloadPDF.php?id=$id'><i class='fa-solid fa-download'></i></a>";
$topics = returnTags($conn,$id);
echo "<p>$topics</p>";

/* do something here if the writing is a contest entry, so that only judges can mark it. */
createRatingSliderForUser($conn,$id,$user);


echo "<div id='particles-js'></div>";
echo "</div>";


?>
<?php include('partial/footer.php');?>

<script type="text/javascript" src="scripts/work.js"></script>
