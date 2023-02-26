<?php
    //require 'vendor/autoload.php';
    session_start();

    //define('SITEURL', 'http://localhost/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'topscribe');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
/*
    if(empty($_SESSION['name'])){
        $_SESSION['name'] = 'Guest';
    }*/
//0 - publish 1 - anonymous 2 - hidden 3 - draft
function publishWriting($conn, $title,$body,$authorID,$status=0,$subcategoryID=19){
    $sql = "insert into writing (title, body, authorID,status,subcategoryID) value ('$title' , '$body', '$authorID','$status','$subcategoryID')";
    mysqli_query($conn,$sql);
    $writing_id = mysqli_insert_id($conn);
    return $writing_id;
}
function saveAsDraft($conn, $title,$body,$authorID,$subcategoryID){
    publishWriting($conn, $title,$body,$authorID,3,$subcategoryID);
}
function showWriting($conn,$id){
    //show : title, body liimited to 100 char
    //read time : trim length 
    //subcategory
    $sql = "SELECT title,left(body,100) as blurb,round((length(body)+240)/1440,0) as readtime,subcategory.name as subcategory FROM `writing` join `subcategory` on writing.subcategoryID=subcategory.id WHERE writing.id = ".$id;
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);


    $title = $row['title'];
    $blurb = $row['blurb'];
    $readtime = $row['readtime']==0?'< 1':$row['readtime'];
    $readtime.=' min read';
    $subcategory = $row['subcategory'];


//<div class="list-group">
$card = 
"<a href='work.php?id='".$id."' class='list-group-item list-group-item-action flex-column align-items-start'>
  <div class='d-flex w-100 justify-content-between'>
    <h5 class='mb-1'>$title</h5>
    <small>$readtime</small>
  </div>
  <p class='mb-1'>$blurb</p>
  <small>$subcategory</small>
</a>";

echo $card;

//</div>


}
?>