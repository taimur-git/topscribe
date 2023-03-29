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
function showAllWriting($conn, $status=0){
    $cards = "<div class='list-group'>";
    $sql = "SELECT usernames.username as author, usernames.photo as photo, writing.id as id,
    title,left(body,430) as blurb,
    round((length(trim(body))+240)/1440,0) as readtime,
    subcategory.name as subcategory, views
    FROM `writing` join `subcategory` on writing.subcategoryID=subcategory.id
    join usernames on usernames.id=writing.authorID
    where writing.status = $status";
    $res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($res)){
    $writeID = $row['id'];
    $title = $row['title'];
    $blurb = $row['blurb']."...";
    $readtime = $row['readtime']==0?'< 1':$row['readtime'];
    $readtime.=' min read';
    $subcategory = $row['subcategory'];
    $topics = returnTags($conn,$writeID);
    $views = $row['views'];
    $bookmarks = getBookmarks($conn,$writeID);
  $author = $row['author'];
  $imgurl = $row['photo'];//check if null then default
  
  //return $author;
  $profileView =  "<div class='side-profile'><img class='profile-pic' src='$imgurl'>";
  $profileView .= "<h5>$author</h5></div>";

    $stats = "$views <i class='fa-solid fa-eye'></i> $bookmarks <i class='fa-regular fa-bookmark'></i>";
$cards .= 
"<div class='full-article'>$profileView<div class='article-preview'><a href='work.php?id=$writeID' class='article-link list-group-item list-group-item-action flex-column align-items-start'>
  <div class='d-flex w-100 justify-content-between'>
    <h5 class='mb-1'>$title</h5>
    <small>$readtime</small>
  </div>
  <p class='mb-1 blurb'>$blurb</p>
  <div class='d-flex w-100 justify-content-between'>
  <small>$subcategory $topics</small>
  <span>$stats</span>
  </div>
  
</a></div></div>";
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
    <textarea class='card-text' id='simplemde'>$body</textarea>
  </div>
</div></div>";
echo $card;
}

function showAllContest($conn){
    $sql = "select contest.id as id, contest.title as title, concat(left(contest.description,100),'...') as blurb, start, end, capacity, subcategory.name as subcategory, category.name as category, count(contestusers.writerID) as registered, usernames.username as host
    from contest join subcategory on contest.subcategoryID = subcategory.id
    join category on subcategory.catID = category.id
    join usernames on contest.hostID = usernames.id
    left join contestusers on contest.id = contestusers.contestID
    group by contest.id";

$res = mysqli_query($conn,$sql);
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
}
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
  $sql = "DELETE FROM topicwriting WHERE wid='$writingid'";
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
function createTopicInput(){
$privacy = "<fieldset>
<legend>Privacy settings:</legend>

<div>
  <input type='radio' id='public' value='0' name='audience'
         checked>
  <label for='0'>Public</label>
</div>

<div>
  <input type='radio' id='private' value='1' name='audience'>
  <label for='1'>Private</label>
</div>

<div>
  <input type='radio' id='anonymous' value='2' name='audience'>
  <label for='2'>Anonymous</label>
</div>
</fieldset>";

$inputbar = "
<input type='text' size='30' onkeyup='lookupTopic(this.value)' id='topic-input'>
<div id='livesearch'></div>
";

      $html = "<div class='form-check form-switch'>
        <input class='form-check-input' type='checkbox' id='flexSwitchCheckChecked' onclick='boxClicked()'>
        <label class='form-check-label' for='flexSwitchCheckChecked'>Automatically generate topics</label>
      </div> ";
      $html .= "<div id='topicDiv'>";
      $html .= $inputbar."
      <div>
        <span id='topics-display'></span>
        <button type='button' class=cleanbutton onclick='generateRandomTopic()'><i class='fa-solid fa-dice'></i></button>
      </div></div>";
      $html = "<div class=bottombar>".$html.$privacy."</div>";
      echo $html;


}

function returnTags($conn,$id){
  $option = "";
  $sql = "SELECT topic.tid as id,name FROM `topicwriting` join writing on topicwriting.wid=writing.id join topic on topicwriting.tid=topic.tid where wid = $id";
  $res=mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];
    $topic = $row['name'];
    $option .= "<span class='badge rounded-pill bg-light' onclick='searchByTopic($id)'>$topic</span>";
  }return $option;
}




function addTopicArr($conn,$topicArr,$writing_id){
  foreach($topicArr as $topic){
    $topic_id = addTopic($conn,$topic);
    $sql = "insert into topicwriting values ('$writing_id','$topic_id')";
    $res = mysqli_query($conn,$sql);
  }
}

function addTopic($conn,$topic){
  $id=0;//added topic id
  $sql = "SELECT tid FROM topic where name = '$topic'";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)==0){
    //topic does not exist
    $sql2 = "insert into topic (name) value ('$topic')";
    mysqli_query($conn,$sql2);
    $id = mysqli_insert_id($conn);
  }else{
    //topic does exist
    $row = mysqli_fetch_assoc($res);
    $id = $row['tid'];
  }
  return $id;
}

function getBookmarks($conn,$writing_id){
  $sql = "select writingid,count(userid) as count from writing join bookmarks on writing.id=bookmarks.writingid group by writingid having writingid='$writing_id'";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)==0){
    return 0;
  }else{
    $row = mysqli_fetch_assoc($res);
    return $row['count'];
  }
}

function addContact($conn,$user1,$user2){
  $sql = "insert into contacts value ('$user1','$user2')";
  mysqli_query($conn,$sql);
}
function viewContacts($conn,$user){
  $sql = "select user2id as id, from contacts join usernames on  where user1id='$user'";

}
function addContactToGroup(){}
?>
