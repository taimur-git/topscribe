<?php
include('partial/navbar.php');
?>
<?php
$id = $_GET['id'];


incrementView($conn,$id);
//render the page
displayWriting($conn,$id);
echo "<div class='profilebar'>";
$writer = profileView($conn,$id);
if(isset($_SESSION['id'])){
    $user = $_SESSION['id'];
    $flag = ifBookmark($conn,$user,$id);
    $bookmark = "<button onclick='toggleBookmark($id)' class=cleanbutton><i class='fa-";
    $bookmark.= $flag ? "solid" : "regular";
    $bookmark.= " fa-bookmark' id='bookmark'></i></button>";
    echo $bookmark;
    if($writer == $user){
        ///something
        //<button href = 'editWriting?id=$id'>
        echo "<button class=cleanbutton><i class='fa-solid fa-pen-to-square'></i></button><button onclick='deleteWriting($id)' class=cleanbutton><i class='fa-solid fa-trash'></i></button>";
    }else{
        echo "<button class=cleanbutton><i class='fa-solid fa-user-plus'></i></button>";
    }
    
}
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "<button type='button' class=cleanbutton data-bs-container='body' data-bs-toggle='popover'
data-bs-placement='bottom' data-bs-content='$url' onclick='copyToClipboard()'>
<i class='fa-solid fa-link'></i>
</button>";
echo "<button type='button' class=cleanbutton onclick='downloadPDF()'><i class='fa-solid fa-download'></i></button>";
$topics = returnTags($conn,$id);
echo "<p>$topics</p>";

echo "</div>";


?>

<?php include('partial/footer.php');?>