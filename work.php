<?php
include('partial/navbar.php');
?>
<body>
<?php
$id = $_GET['id'];
$user = $_SESSION['id'];
$flag = ifBookmark($conn,$user,$id);
incrementView($conn,$id);
//render the page
displayWriting($conn,$id);
echo "<div class='profilebar'>";
profileView($conn,$id);
if(isset($_SESSION['name'])) {
  $bookmark = "<button onclick='toggleBookmark($id)' class=cleanbutton><i class='fa-";
  $bookmark.= $flag ? "solid" : "regular";
  $bookmark.= " fa-bookmark' id='bookmark'></i></button>";
  echo $bookmark;
}
echo "</div>";


?>

<script type="text/javascript" src="script.js"></script>
</body>