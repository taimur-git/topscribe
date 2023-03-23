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
function showAllWriting($conn){
    //replace(body,'#*>[]','')
    //concat ...
    //SELECT title, count(userid) FROM `writing` right join `bookmarks` on writing.id=bookmarks.writingid
    $cards = "<div class='list-group'>";
    $sql = "SELECT writing.id as id,
    title,left(body,430) as blurb,
    round((length(trim(body))+240)/1440,0) as readtime,
    subcategory.name as subcategory
    FROM `writing` join `subcategory` on writing.subcategoryID=subcategory.id
    where writing.status = 0";
    $res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($res)){
    $writeID = $row['id'];
    $title = $row['title'];
    $blurb = $row['blurb']."...";
    $readtime = $row['readtime']==0?'< 1':$row['readtime'];
    $readtime.=' min read';
    $subcategory = $row['subcategory'];
//"<a href='work.php?id=$writeID' class='list-group-item list-group-item-action flex-column align-items-start'>
$cards .= 
"<a href='work.php?id=$writeID' class='list-group-item list-group-item-action flex-column align-items-start'>
  <div class='d-flex w-100 justify-content-between'>
    <h5 class='mb-1'>$title</h5>
    <small>$readtime</small>
  </div>
  <p class='mb-1 blurb'>$blurb</p>
  <small>$subcategory</small>
</a>";
}
    $cards.='</div>';

echo $cards;
}

function displayWriting($conn,$id){
    $sql = "select title, body, username as author, datePublished, subcategory.name as subcategory
    FROM `writing` join `subcategory` on writing.subcategoryID=subcategory.id
    join `usernames` on writing.authorID=usernames.id
    where writing.id = $id";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);

    $title = $row['title'];
    $body = $row['body'];
    $author = $row['author'];
    $date = $row['datePublished'];
    $subcategory = $row['subcategory'];


    $card = "<div class=writing>
    <div class='card' style='border:none;'>
  <div class='card-body'>
    <h4 class='card-title'>$title</h4>
    <h6 class='card-subtitle mb-2 text-muted'>$date</h6>
    <p class='card-text'>$body</p>
  </div>
</div></div>";
echo $card;

}

function showAllContest($conn){
  //$cards ="";
    $sql = "select contest.id as id, contest.title as title, concat(left(contest.description,100),'...') as blurb, start, end, capacity, subcategory.name as subcategory, category.name as category, count(contestusers.writerID) as registered, usernames.username as host
    from contest join subcategory on contest.subcategoryID = subcategory.id
    join category on subcategory.catID = category.id
    join usernames on contest.hostID = usernames.id
    left join contestusers on contest.id = contestusers.contestID
    group by contest.id";

    /*select contest.id as id, contest.title as title, concat(left(contest.description,100),'...') as blurb, start, end, capacity, subcategory.name as subcategory, usernames.username as host
    from contest join subcategory on contest.subcategoryID = subcategory.id
    join category on subcategory.catID = category.id
    join usernames on contest.hostID = usernames.id*/
//, count(contestusers.writerID) as registered on each
$res = mysqli_query($conn,$sql);
//echo $res;
while($row = mysqli_fetch_assoc($res)){
    $contestID = $row['id'];
    $title = $row['title'];
    $blurb = $row['blurb']; //check if start date is passed, then show
    $startDate = $row['start'];
    $endDate = $row['end']; 
    $capacity = $row['capacity']; //can be null
    $subcategory = $row['subcategory'];
    $category = $row['category'];
    $registered = $row['registered'];
    $host = $row['host'];
    
//div class = row
//div class = col lg 4
//div class = bs-component
    //maybe depending on category, we have different colors. like red for essay, green for article, blue for poetry
    //and the card body could be white for contests, black for requests?
$card = "
    <div class='card mb-3 contestcard'>
  <h3 class='card-header'>$title</h3>
  <div class='card-body'>
    <h5 class='card-title'>$subcategory</h5>
    <h6 class='card-subtitle text-muted'>Hosted by: $host</h6>
  </div>
  <div class='card-body'>
    <p>$blurb</p>";
    //"<p>$registered registed out of $capacity filled.</p> "
    //<span class="badge bg-primary rounded-pill">$registered / $capacity</span>
  $card .= "</div>
  <div class='card-footer text-muted'>
    $startDate
  </div>
</div>
";
echo $card;
//$cards .= $card;

}
//echo $cards;
}

function createContest($conn, $title, $description,$host,$subcategoryID=19,$capacity=null,$start=null,$end=null,$judges=null,$classroom=null){
  $sql = $start==null ? 
  "insert into contest
  (title, description,hostID,subcategoryID)
  value ('$title' , '$description','$host','$subcategoryID')"
  : 
  "insert into contest
  (title, description, start,end,capacity,judgeGroup,writerGroup,hostID,accepted,subcategoryID)
  value ('$title' , '$description', '$start','$end','$capacity','$judgeGroup','$writerGroup','$host','$accepted','$subcategoryID')" ;

    mysqli_query($conn,$sql);
    $contest_id = mysqli_insert_id($conn);
    return $contest_id;
}

function incrementView($conn, $id){
  $sql = "update writing
  set views = views + 1
  where id='$id'";
  mysqli_query($conn,$sql);
}

function addBookmark($conn, $userid, $writingid){
  $sql = "INSERT INTO bookmarks
  VALUES ('$userid' , '$writingid')";
  mysqli_query($conn,$sql);
}

function removeBookmark($conn, $userid, $writingid){
  $sql = "DELETE FROM bookmarks WHERE userid='$userid' and writingid='$writingid'";
  mysqli_query($conn,$sql);
}

function deleteWriting($conn,$writingid){
  $sql = "DELETE FROM bookmarks WHERE writingid='$writingid'";
  mysqli_query($conn,$sql);
  $sql = "DELETE FROM writing WHERE id='$writingid'";
  mysqli_query($conn,$sql);
}


function profileView($conn,$id){
  $sql = "select usernames.id as uid, username,photo from usernames
  join writing on writing.authorID=usernames.id
  where writing.id = $id";

  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);

  $author = $row['username'];
  $imgurl = $row['photo'];//check if null then default
  $uid = $row['uid'];
  //return $author;
  echo "<img class='profile-pic' src='$imgurl'>";
  echo "<h5>$author</h5>";
  return $uid;
}
function ifBookmark($conn,$userid,$writingid){
  $sql = "select * from bookmarks where userid='$userid' and writingid = '$writingid'";
  $res=mysqli_query($conn, $sql);
  return mysqli_num_rows($res)!=0;
}

function createCategorySelect($conn){
  $sql = "select * from category";
  $res=mysqli_query($conn, $sql);
  echo "<label>Select Category:
  <select name='subcategory' id='category-select' onchange='changeTooltip()'>
  ";
  while($row = mysqli_fetch_assoc($res)){
    $catid = $row['id'];
    $name = $row['name'];
    echo "<optgroup label='$name'>";
    echoSubCategoryOptions($conn, $catid);
    echo "</optgroup>";
  }
  echo "</select></label>";
  
}

function echoSubCategoryOptions($conn, $catid){
  $sql = "select * from subcategory where catid = $catid";
  $res=mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($res)){
    $subid = $row['id'];
    $name = $row['name'];
    $option = "<option value='$subid'>$name</option>";
    echo $option;
  }
}
function returnDescriptionSubCategory($conn,$subID){
  $sql = "select description from subcategory where id='$subID'";
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);
  $description = $row['description'];
  return $description;
}
function createTopicInput(){}
/*
<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
        <label class="form-check-label" for="flexSwitchCheckChecked">Automatically generate topics</label>
      </div> 
      */
?>