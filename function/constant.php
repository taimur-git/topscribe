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
    $currentDateTime = date("Y-m-d H:i");



    class Writing{
      public $writeID;
      public $title;
      public $blurb;
      public $readtime;
      public $subcategory;
      public $topics;
      public $views;
      public $bookmarks;
      //not needed if its the user.
      public $author;
      public $imgurl;
      public $authorID;
      public $topicArr;

      public $marks;
      public $contestID;

      function generate($row,$conn){
        $this->writeID = $row['id'];
        $this->title = $row['title'];
        $this->blurb = $row['blurb']."...";
        $this->readtime = $row['readtime']==0?'< 1':$row['readtime'];
        $this->readtime.=' min read';
        $this->subcategory = $row['subcategory'];
        $this->topics = returnTags($conn,$this->writeID);
        $this->views = $row['views'];
        $this->bookmarks = $row['bookmarks'];
        //not needed if its the user.
        $this->author = $row['author'];
        $this->imgurl = $row['photo'];
        $this->authorID = $row['authorid'];
        $this->topicArr = json_decode($row['topics']);
      }
      function generate2($row){
        $this->contestID = $row['contestID'];
        $this->writeID = $row['id'];
        $this->title = $row['title'];
        $this->authorID = $row['authorID'];
        $this->marks = $row['avg(score)'];
        $this->blurb = $row['blurb']."...";
        $this->readtime = $row['readtime']==0?'< 1':$row['readtime'];
        $this->readtime.=' min read';

      }
  }

  class Contest{
    public $id;
    public $title;
    public $description;
    public $startTime;
    public $endTime;
    public $capacity;
    public $judgeGroup;
    public $writerGroup;
    public $hostID;
    public $accepted;
    public $subcategoryID;
    public $subcategoryName;
    public $subcategoryDescription;
    public $bannerURL;
    public $hostName;
    public $state;//0 - early,1-ongoing, 2-late 
    public $type; //0 - contest, 1-assignemnt, 2- request
    public $stateStr = ["Not Started Yet","Ongoing","Closed"];
    public $typeStr = ["Contest","Assignment","Request"];
    
    public $countRegistered;
    public $countEntries;
    public $countMarked;
    //sql tables 
    public $contestEntries;
    public $judges;
    public $writers;
    public $registered;

    public static function getBaseSQL(){
        return "SELECT distinct CURRENT_DATE<contest.start as early , CURRENT_DATE>contest.end as late, (CURRENT_DATE>contest.start and CURRENT_DATE<contest.end) as ongoing, 
      contest.*, usernames.username, usernames.canHost, subcategory.name,subcategory.description as subcategoryhelp
      FROM `contest` join usernames on contest.hostID=usernames.id join subcategory on contest.subcategoryID=subcategory.id ";
    }
    //have functions for the search and filter options too
    public static function getHostedContests($id){
      $sql = "where hostID='$id'";
      return Contest::getBaseSQL().$sql;
    }
    public static function getJudgedContests($id){
      $sql = "left join grouplist on judgeGroup = groupID where ( grouplist.userid = '$id' or hostID = '$id') ";
      return Contest::getBaseSQL().$sql;
    }
    public static function getRegisteredContests($id){
      $sql = "join contestusers on contestusers.contestID=contest.id 
      left join grouplist on writerGroup = groupID where ( grouplist.userid = '$id' or contestusers.writerID='$id');";
      return Contest::getBaseSQL().$sql;
    }
    public static function getSingleRow($id){
      $sql = "where contest.id='$id'";
      return Contest::getBaseSQL().$sql;
    }
    public static function getAcceptedContests($flag=true){
      $sql = $flag ? "where accepted=1" : "where accepted=0";
      return Contest::getBaseSQL().$sql;
    }
    function returnPieChart(){
      $mark = $this->countMarked;
      $sub = $this->countEntries - $this->countMarked;
      $reg = $this->countRegistered - $this->countEntries;
      return "[$reg,$sub,$mark]";
      
      //['Registered','Submitted','Marked']
    }
    function returnListOfJudges(){
      while($row = mysqli_fetch_assoc($this->judges)){
          $id = $row['id'];
          $user = $row['username'];
          echo "<span class='badge rounded-pill bg-light'><a href='user.php?id=$id'>$user</a></span>";
      }    
    }
    function returnListOfContestants(){
      $flag2 = true;
      $flag = $this->type!=1;
      $sql = $flag ? $this->registered : $this->writers;
      while($row = mysqli_fetch_assoc($sql)){
        $flag2 = false;
        $id = $row['id'];
        $user = $row['username'];
        echo "<span class='badge rounded-pill bg-light'><a href='user.php?id=$id'>$user</a></span>";
      } 
      if($flag2){
        echo "<p>No participants.</p>";
      }
    }
    function getExtraInfo($conn){
      $id = $this->id;
      /*
      $sql = "SELECT contestID,id,title,body,authorID,judgeID,datePublished,score,
      left(body,100) as blurb,
      round((length(trim(body))+240)/1440,0) as readtime
       FROM `contestwriting` 
      join writing on writingID=writing.id left join marks on contestwriting.writingID=marks.writingID where contestID='$id'";
      */
      $sql1 = "SELECT contestID,id,title,body,authorID,datePublished,avg(score),
      left(body,100) as blurb,
      round((length(trim(body))+240)/1440,0) as readtime
       FROM `contestwriting` 
      join writing on writingID=writing.id left join marks on contestwriting.writingID=marks.writingID where contestID='$id' group by contestwriting.writingID";
      $this->contestEntries = mysqli_query($conn,$sql1);
      
      $sql = "SELECT * FROM `contestusers` join usernames on writerID=usernames.id where contestid='$id'";
      $this->registered = mysqli_query($conn,$sql);
      
      $judgeGroup=$this->judgeGroup;
      $writerGroup=$this->writerGroup;
      $sql = "SELECT id,username from grouplist join usernames on grouplist.userID=usernames.id where groupID='$judgeGroup'";
      $this->judges = mysqli_query($conn,$sql);
      $sql = "SELECT id,username from grouplist join usernames on grouplist.userID=usernames.id where groupID='$writerGroup'";
      $this->writers = mysqli_query($conn,$sql);

      $this->countEntries = mysqli_num_rows($this->contestEntries);
      $this->countRegistered = $this->type==1 ?mysqli_num_rows($this->writers):mysqli_num_rows($this->registered);
      //$this->getMarkCount();

      $i = 0;
      //$this->countMarked;
      $res = mysqli_query($conn,$sql1);
      while($row = mysqli_fetch_assoc($res)){
        $obj = new Writing();
        $obj->generate2($row);
        if($obj->marks!=null){
          $i = $i + 1;
        }
        //echo printContestEntry($obj);
      }
      $this->countMarked = $i;



    }
    function getInfoByID($cid,$conn){
      $this->id = $cid;
      $sql = Contest::getSingleRow($this->id);
      $res = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($res);
      $this->getInfo($row,$conn);
    }
    function getMarkCount(){
      $i = 0;
      //$this->countMarked;
      
      $res = $this->contestEntries;
      while($row = mysqli_fetch_assoc($res)){
        $obj = new Writing();
        $obj->generate2($row);
        if($obj->marks!=null){
          $i = $i + 1;
        }
        //echo printContestEntry($obj);
      }
      $this->countMarked = $i;
    }
    function getInfo($row,$conn){
      
      $this->id=$row['id'];
      $this->title=$row['title'];
      $this->description=$row['description'];
      $this->startTime=$row['start'];
      $this->endTime=$row['end'];
      $this->capacity = $row['capacity'];
      $this->judgeGroup=$row['judgeGroup'];
      $this->writerGroup=$row['writerGroup'];
      $this->hostID=$row['hostID'];
      $this->accepted=$row['accepted'];
      $this->subcategoryID=$row['subcategoryID'];
      $this->bannerURL=$row['bannerurl'];
      $this->hostName=$row['username'];
      //$this->=$row['canHost'];
      $this->subcategoryName = $row['name'];
      $this->subcategoryDescription = $row['subcategoryhelp'];

      if($row['early']==1){
        $this->state = 0;
      }else if($row['ongoing']==1){
        $this->state = 1;
      }else{//|| $this->capacity-$this->countRegistered<=0
        $this->state = 2;
      }
      //if capacity = 1, its a request
      //if a writergroup exists, its an assignment.
      //else, its a contest.
      if($this->capacity == 1){
        $this->type = 2;
      }else if($this->writerGroup!=0){
        $this->type = 1;
      }else{
        $this->type = 0;
      }

      $this->getExtraInfo($conn);
    }

    function returnScoreList2($conn){
      $id = $this->id;
      $arr = array_fill(0,11,0);
      $sql = "select ceil(t1.marks) as score,count(t1.id) as contestants from (SELECT id,avg(score) as marks
           FROM `contestwriting` 
          join writing on writingID=writing.id 
          left join marks on contestwriting.writingID=marks.writingID 
          where contestID='$id' group by contestwriting.writingID)t1 group by ceil(t1.marks)";
          $res = mysqli_query($conn,$sql);
    
          while($row = mysqli_fetch_assoc($res)){
            $x = $row['score'];
            $y = $row['contestants'];
            if($x!=null){$arr[$x]=$y;}
          }
          
          return str_replace('"', '', json_encode($arr));
    
    
    }

    function createContestListItem(){
      return contestListItem(
        $this->id,
        $this->title,
        $this->startTime,
        $this->countRegistered,
        $this->capacity,
        $this->description,
        $this->endTime,
        $this->state,
        $this->type
      );
    }



    function printEntries($conn){
      //getInfoByID($id,$conn);
      $flag = true;
      echo "<div class='list-group'>";
      //$sql = $this->contestEntries;
      //$res = mysqli_query($conn,$sql);
      $res = $this->contestEntries;
      while($row = mysqli_fetch_assoc($res)){
        $obj = new Writing();
        $obj->generate2($row);
        echo printContestEntry($obj);
        $flag = false;
      }
      if($flag){echo "<p>There are no entries.</p>";}
      echo "</div>";
    }
    
    function createButtons($user=-1,$conn=null,$inContest=true){
      $id = $this->id;
      $hostid = $this->hostID;
      $state = $this->state;
      $userWrittenFlag = ifWrittenToContest($conn,$id,$user);
      $userRegisterFlag = ifRegisteredToContest($conn,$id,$user);
      $judgeFlag = isContestJudge($conn,$id,$user);
      //$studentFlag = allowedInContest($conn,$id,$user);
      $hostFlag = $user == $hostid || $judgeFlag;
      $guestFlag = $user == -1;
      $adminFlag = $user == 0;
      $assignmentNotFlag = $this->type!=1;

      $card = $inContest ? "<a class='btn btn-info' href='browse.php'>Back</a>" : "<a class='btn btn-info' href='contest.php?id=$id'>View</a>";
      $registerButton =  "<a class='btn btn-info' href='function/contestRegister.php?cid=$id'>Register</a>";
      $enterButton = "<a class='btn btn-info' href='editor.php?cid=$id'>Enter</a>";

      //buttons that do not work yet.
      $endButton = "<a class='btn btn-danger disabled' href='function/contestEnd.php?cid=$id'>End Contest</a>";
      $editEntryButton = "<a class='btn btn-info disabled' href='edit.php?id='>Edit Entry</a>";
      $editContestButton = "<a class='btn btn-info disabled' href='editContest.php?cid=$id'>Edit Contest</a>";
      $unregisterButton = "<a class='btn btn-info disabled' href='unregister.php?cid=$id'>Unregister</a>";

      $approveAllButton = "<a class='btn btn-info' href='function/approveContest.php?id=3&cid=$hostid'>Approve All Now</a>";
      $approveFutureButton = "<a class='btn btn-info' href='function/approveContest.php?id=2&cid=$hostid'>Approve Future</a>";
      $approveContestButton = "<a class='btn btn-info' href='function/approveContest.php?id=1&cid=$id'>Approve</a>";
      $denyButton = "<a class='btn btn-danger ' href='function/deleteContest.php?cid=$id'>Deny</a>";
      /*
       approveAllForUser()
    approveContest()
    approveFuture()
       */
      $adminPanel = "<div>".$card.$approveContestButton.$denyButton."</div><div>".$approveAllButton.$approveFutureButton."</div>";

      $userButton = $userRegisterFlag ? $unregisterButton : $registerButton;
      $userButton2 = $userWrittenFlag ? $editEntryButton : $enterButton;

      $assignmentButton = $assignmentNotFlag ? $userButton : "";
      //$entryButton = $studentFlag ? $userButton2 : "";

      //figure out who the user is.
      //if its a guest, do nothing.
      if($guestFlag){return $card;}
      if($adminFlag){return $adminPanel;}
      //if its the host, give them their buttons.
      if($hostFlag){
        switch($state){
          case 1:
            $card .= $editContestButton;
          case 0:
            $card .= $endButton;
        }
      }else{
          //if its not the host, give them their buttons.
          switch($state){
            case 0:
              $card .= $assignmentButton;
              break;
            case 1:
              $card .= $assignmentButton;
              $card .= $userButton2;
              break;
          }
      }
      
      return $card;
    }
    function createContestCard($user=-1,$conn=null){
      $bannerurl = $this->bannerURL;
      $title = $this->title;
      $subcategory = $this->subcategoryName;
      $host = $this->hostName;
      $hostid = $this->hostID;
      $description = $this->description;
      $entries = $this->countEntries;
      $registered = $this->countRegistered;
      $capacity = $this->capacity;
      $id = $this->id;
      $startTime = $this->startTime;
      $endTime = $this->endTime;
      $hostFlag = $user == $hostid;
      $assignmentFlag = $this->type==1;

      $allowedInContest = allowedInContest($conn,$id,$user);
      $isJudge = $hostFlag || isContestJudge($conn,$id,$user);
      $allowedAssignment = $allowedInContest || $isJudge;
      //$userWrittenFlag = ifWrittenToContest($conn,$id,$user);//change this
      //$userRegisterFlag = ifRegisteredToContest($conn,$id,$user);//change this
      if($assignmentFlag&&!$allowedAssignment){
        return "";
      }
      $card = "
        <div class='card mb-3 contestcard'>
        <img class='card-img-top contest-banner' src='$bannerurl' alt='contest banner'>
      <h3 class='card-header'>$title</h3>
      <div class='card-body'>
        <h5 class='card-title'>$subcategory</h5>
        <h6 class='card-subtitle text-muted'>Hosted by: <a href='user.php?id=$hostid'>$host</a></h6>
      </div>
      <div class='card-body'>
        <p>$description</p>";

      $card .= $this->type!=2 ? "<p><span class='badge bg-primary rounded-pill'>$entries/$registered submitted</span> ":"<p>";
      if($this->type==2){
        $card .= $registered>0&&$this->state != 2 ? "<span class='badge bg-danger rounded-pill'>Request is unavailable</span>" : "<span class='badge bg-success rounded-pill'>Request is available</span>";

      }
    
      $card .= $this->type==0 ? "<span class='badge bg-primary rounded-pill'>$registered":"";
      $card .= $this->type==0&&$capacity > 1 ? "/$capacity ":""; 
      $card .= $this->type==0 ? " registered</span></p>":"</p>";
      $card .= $this->createButtons($user,$conn,false);
  $pill=createPill($this->typeStr[$this->type]);
  $statusStr = createPill($this->stateStr[$this->state],false);
  $card .= "</div>
  <div class='card-footer text-muted'>
    <div>$pill $statusStr</div>
    Start : $startTime<br>
    End: $endTime
  </div>


</div>
";
return $card;
    }


  }
  
  function breakSearchTerm($search,$query="concat(nvl(topics,''),title,t1.username,t1.subcategory)"){
    //split the search into constituent words.
    // where concat(topics,title,t1.username) like '%taimur%' and concat(topics,title,t1.username) like '%gpt%'
    $data   = preg_split('/\s+/', $search);
    $sql =" ";
    foreach($data as $searchTerm){
        $sql1 = $query." like '%$searchTerm%' ";
        $sql1.="and ";
        $sql.=$sql1;
    }
    $sql = trim($sql,"and ");
    return $sql;
  }
  function showAllWriting($conn, $case=0,$user=0,$search='',$order=0,$asc=2,$top=0,$echoFlag=true){
    $flag = true;
    $flag2 = false;
    $flag3 = true;
    $blurbLimit = 430;
    if($top!=0){
      $flag2 = true;
      $order = 3;//or 4, if you want most views writings.
      $asc = 2;
      $blurbLimit = 100;
    }
    $dq ='"';
      $cards = "<div class='list-group";
      if($flag2){ $cards.= " top-articles ";}
      if($user!=0){ $cards .=" items-aligned-center ";}
      $cards .= "'>";
  
      $sql = "select t1.username as author, t1.photo as photo, t1.id as id,
      t1.title as title,left(t1.body,$blurbLimit) as blurb,
      round((length(trim(t1.body))+240)/1440,0) as readtime,
      t1.subcategory as subcategory, t1.views as views, t1.authorid as authorid, nvl(bookmarkcount,0) as bookmarks, nvl(topics,'') as topics from 
        (
          SELECT writing.id as id, title, body, authorID, datePublished, status, subcategoryID, views, catID, name as subcategory, username, featuredWriting, photo 
          FROM `writing` join `subcategory` on writing.subcategoryID=subcategory.id
          join usernames on usernames.id=writing.authorID 
        ) t1
        left join 
        (
          SELECT writingid as id, count(userid) as bookmarkcount FROM `bookmarks` group by writingid
        ) t2  
        on t1.id = t2.id 
        left join
        (SELECT wid, concat('[',GROUP_CONCAT(concat('$dq',name,'$dq')),']') as topics 
        FROM `topicwriting` join topic on topicwriting.tid = topic.tid 
        join writing on writing.id = topicwriting.wid group by id
        ) t3
        on t1.id = t3.wid ";
      switch($case){
        case 1:
          //default case
          $sql .= "where t1.status = 0 ";
          break;
        case 2:
          //your bookmarks
          $sql .= "join bookmarks on bookmarks.writingid = t1.id where bookmarks.userid = '$user' ";
          break;
        case 3:
          //someone's public writings
          //$sql .= "where t1.authorID = '$user' and t1.status = '0' ";
          $sql .= "where t1.authorID = '$user' and t1.status = '0' ";
          $flag = false;
          break;
        case 4:
          //someone's private writings
          $sql .= "where t1.authorID = '$user' and t1.status = '1' ";
          $flag = false;
          break;
          //anonymous?
        case 5:
            //someone's contest entries
            $sql .= "where t1.authorID = '$user' and t1.status = '3' ";
            $flag = false;
            break;
            //anonymous?
        default:
          $sql .= "where t1.status = 0 ";

      }
      $sql .= " and ".breakSearchTerm($search);
      //" and concat(topics,title,t1.username) like '%$search%' ";
      //$sql .= " ";
      //public writings.
      switch($order){
        case 1:
          //datepublished
          $sql .= " order by t1.datePublished ";
          break;
        case 2:
          //views
          $sql .= " order by views ";
          break;
        case 3:
          //bookmarks
          $sql .= " order by bookmarks ";
          break;
        case 4:
          //readtime
          $sql .= " order by readtime ";
          break;
        default:
          $sql .= " order by t1.datePublished ";
          //if anything else, aka 0, then dont sort.

      }
      //if($order!=0){
        switch($asc){
          case 1:
            $sql .= " asc ";
            break;
          case 2:
            $sql .= " desc ";
            break;
          default:
          $sql .= " desc ";
        }
      //}
      if($flag2){
        $sql .= " limit $top";
      }
      $res = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($res)){
          $obj = new Writing();
          $obj->generate($row,$conn);
          $cards .= $flag2?renderTopWritings($obj):renderWritingFromObj($obj,$flag);
          $flag3=false;
      }
      $cards.='</div>';
      $cards = $flag3?"No results.":$cards;
      if($echoFlag) {echo $cards;}
      return $cards;
  }
  function renderTopWritings($obj){
    /*
    $obj->writeID,
    $obj->title,
    $obj->blurb,
    $obj->readtime,
    $obj->subcategory,
    $obj->topics,
    $obj->views,
    $obj->bookmarks,
    $obj->author,
    $obj->imgurl,
    $obj->authorID
    */
  return "<a class='list-group-item d-flex justify-content-between align-items-start
   top-article hidden' href='work.php?id=$obj->writeID'>
    <div class='ms-2 me-auto'>
      <h5>$obj->title</h5>
      $obj->blurb
    </div>
    <div>
    <small>$obj->subcategory $obj->topics</small>
    </div>
  </a>";
  }
  function renderWritingFromObj($obj,$flag=true){
    
    return $flag ? renderWritingThumbs(
      $obj->writeID,
      $obj->title,
      $obj->blurb,
      $obj->readtime,
      $obj->subcategory,
      $obj->topics,
      $obj->views,
      $obj->bookmarks,
      $obj->author,
      $obj->imgurl,
      $obj->authorID
    ):renderWritingThumbs(
      $obj->writeID,
      $obj->title,
      $obj->blurb,
      $obj->readtime,
      $obj->subcategory,
      $obj->topics,
      $obj->views,
      $obj->bookmarks
    )
    ;
  }
  
  function renderWritingThumbs($writeID,$title,$blurb,$readtime,$subcategory,$topics,$views,$bookmarks,$author=null,$imgurl=null,$authorID=null){
  //return $author;
  $profileView = ($author==null||$imgurl==null||$authorID==null) ? "" : renderProfileView($imgurl,$author,$authorID);
  
    $stats = "$views <i class='fa-solid fa-eye'></i> $bookmarks <i class='fa-regular fa-bookmark'></i>";
  $card = 
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
  return $card;
  }
  
  function renderProfileView($imgurl,$author,$authorID){
    $profileView =  "<div class='side-profile'><img class='profile-pic' src='$imgurl'>";
  $profileView .= "<h5><a href='user.php?id=$authorID'>$author</a></h5></div>";
  return $profileView;
  }

//0 - publish 1 - anonymous 2 - hidden 3 - draft
function publishWriting($conn, $title,$body,$authorID,$status=0,$subcategoryID=19){
  //strip the body of any ` and replace it with ' ?
  $body = addslashes($body);
    $sql = "insert into writing (title, body, authorID,status,subcategoryID) value ('$title' , '$body', '$authorID','$status','$subcategoryID')";
    mysqli_query($conn,$sql);
    $writing_id = mysqli_insert_id($conn);
    return $writing_id;
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
    $body = stripslashes($body);
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

function showAllContest($conn,$user=0){
    //$sql = Contest::getBaseSQL();
    $sql = Contest::getAcceptedContests($user!=0);
    $res = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($res)){
      $obj = new Contest();
      $obj->getInfo($row,$conn);
      $card = $obj->createContestCard($user,$conn);
      echo $card;
    }
}

function renderContestListView($conn,$user=0,$host=1){
  switch($host){
    case 1:
      $sql = Contest::getHostedContests($user);
      break;
    case 2:
      $sql = Contest::getJudgedContests($user);
      break;
    case 3:
      $sql = Contest::getRegisteredContests($user);
      break;
    default:
    $sql = Contest::getBaseSQL($user);
    break;
  }
//  $sql = $host?Contest::getHostedContests($user):Contest::getJudgedContests($user);
  //$sql = Contest::getBaseSQL();
  $res = mysqli_query($conn,$sql);
  $cards ="";
  $flag = true;
  while($row = mysqli_fetch_assoc($res)){
    $obj = new Contest();
    $obj->getInfo($row,$conn);
    $card = $obj->createContestListItem($user);
    $cards .= $card;
    $flag = false;
  }
  return $flag?"No contests.":$cards;
}

function createContest($conn, $title, $description,$host,$subcategoryID=19,$capacity=null,$start=null,$end=null,$judges=null,$classroom=null,$bannerURL="images/banner.png"){
  $accepted = allowedToHost($conn,$host); //check is host is allowed or not
  $sql = $start==null ? 
  "insert into contest
  (title, description,hostID,accepted,subcategoryID)
  value ('$title' , '$description','$host','$accepted','$subcategoryID')"
  : 
  "insert into contest
  (title, description, start,end,capacity,judgeGroup,writerGroup,hostID,accepted,subcategoryID,bannerurl)
  value ('$title' , '$description', '$start','$end','$capacity','$judges','$classroom','$host','$accepted','$subcategoryID','$bannerURL')" ;

    mysqli_query($conn,$sql);
    $contest_id = mysqli_insert_id($conn);

    //from the $classroom variable, already register students.
    /*
    if($classroom!=null||$classroom!=0){
      $sql = "INSERT into contestusers(contestID,writerID)
        select '$contestID',userid from grouplist 
        where groupID = '$classroom'";
    }*/

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
  echo "<label for='category-select'>Select Category:
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

function createGroupSelect($conn,$user,$judge=false){
  //judge false means studentgroup, true means judge
  $sql = "select * from userlist where ownerID='$user'";
  //$sql .= $judge?" and judge=1":" judge=0";
  $res=mysqli_query($conn, $sql);
  echo "<label>Select ";
  echo $judge?"judge panel:":"students: ";
  echo "<select name= ";
  echo $judge?"'judge' id='judge-select' ":"'student' id='student-select' ";
  echo "><option value='0'>--empty--</option>";
  while($row = mysqli_fetch_assoc($res)){
    $groupID = $row['groupID'];
    $name = $row['groupName'];
    $option = "<option value='$groupID'>$name</option>";
    echo $option;
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

function createTopicInput($contestFlag=false,$guestFlag=false,$topics=''){
  if($contestFlag||$guestFlag){return;}
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


</fieldset>";
/*<div>
  <input type='radio' id='anonymous' value='2' name='audience'>
  <label for='2'>Anonymous</label>
</div> */
$inputbar = "
<input placeholder='Enter topics' type='text' size='30' onkeyup='lookupTopic(this.value)' id='topic-input'>
<div id='livesearch'></div>
";

      $html = $guestFlag ?"<div>Add topics (click the dice for random topics)</div>" :"<div class='form-check form-switch'>
        <input class='form-check-input' type='checkbox' id='flexSwitchCheckChecked' name='autogen' onclick='boxClicked()'>
        <label class='form-check-label' for='flexSwitchCheckChecked'>Automatically generate topics</label>
      </div> ";
      $html .= "<div id='topicDiv'>";
      $html .= $inputbar.$topics."
      <div>
        <span id='topics-display'></span>
        <button type='button' class=cleanbutton onclick='generateRandomTopic()'><i class='fa-solid fa-dice'></i></button>
      </div></div>";
      $html = "<div class=bottombar>".$html.$privacy."</div>";
      echo $html;


}



function returnTags($conn,$id,$flag=true){
  $option = "";
  $sql = "SELECT topic.tid as id,name FROM `topicwriting` join writing on topicwriting.wid=writing.id join topic on topicwriting.tid=topic.tid where wid = $id";
  $res=mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];
    $topic = $row['name'];
    $option .= $flag ? "<span class='badge rounded-pill bg-light' onclick='searchByTopic($id)'>$topic</span>" : 
    "<span class='badge rounded-pill bg-light' onclick='removeTopic(this.innerText)'>$topic</span>";
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
function removeContact($conn,$user1,$user2){
  $sql = "delete from contacts where user1id = '$user1' and user2id = '$user2'";
  mysqli_query($conn,$sql);
}
function viewContacts($conn,$user){
  $sql = "select user2id as id, u2.username as friend, u2.photo as photo from 
  contacts join usernames u1 on user1id = u1.id 
  join usernames u2 on user2id = u2.id where user1id='$user'";
  $contactList = "<div id='left' gid=0 class='contact-list drag-section'>
  <h1 class='contact-header'>CONTACTS</h1>";
  $res=mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];
    $friend = $row['friend'];
    $imgurl = $row['photo'];
    
    $contact = createContactString($id,$imgurl,$friend);
    $contactList.=$contact;
  }
$contactList .= "</div>";
echo $contactList;
}
function addContactsToGroup($conn,$gid,$garray){
  //INSERT INTO `grouplist` (`groupID`, `userID`) VALUES ('8', '3'); 
  $sql = "DELETE FROM grouplist WHERE groupID = '$gid'";
  $res = mysqli_query($conn,$sql);
  foreach($garray as $uid){
    $sql = "insert into grouplist value ('$gid','$uid')";
    $res = mysqli_query($conn,$sql);
  }
}

function addGroup($conn,$name,$owner,$judge=0){
  $sql = "insert into userlist (groupName,ownerID,judge) value ('$name','$owner','$judge')";
  mysqli_query($conn,$sql);
  $id = mysqli_insert_id($conn);
  return $id;
}

function viewGroups($conn,$user){
//  $sql = "SELECT grouplist.groupID as gid,userlist.groupName as groupname, grouplist.userID as id,usernames.username as friend, usernames.photo as photo FROM grouplist join userlist on grouplist.groupID=userlist.groupID 
//  join usernames on grouplist.userID = usernames.id
//  where ownerID='$user'";

$groupList =''; 
  $sql = "select groupID as gid,groupName from userlist where ownerID='$user'";
  $res=mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($res)){
    $garray = array();
    $gid = $row['gid'];
    $groupname = $row['groupName'];
    $groupList.= "<div id='right$gid' gid='$gid' class='drag-section'>";

    //$groupList .= "<h3 class='contact-header'>$groupname</h3>";
    $groupList .= "<input type=text class='borderless2' onchange='updateGroupName($gid,this.value)' value='$groupname'></input>";

    $sql2 = "select groupList.userID as id,usernames.username as friend, usernames.photo as photo from groupList join usernames on groupList.userID = usernames.id where groupList.groupID=$gid";
    $res2 = mysqli_query($conn, $sql2);
    while($row2 = mysqli_fetch_assoc($res2)){
      $id = $row2['id'];
      $friend = $row2['friend'];
      $imgurl = $row2['photo'];
      array_push($garray,intval($id));
      $contact = createContactString($id,$imgurl,$friend);
      $groupList.=$contact;
    }
    $garrstring = json_encode($garray);
    $groupList.="<input type=hidden id='contact-array$gid' value='$garrstring'>";
    $groupList.="<button class='cleanbutton' id='remove-group' onclick='removeGroup($gid)'><i class='fa-solid fa-trash'></i></button></div>";
  }
  echo $groupList;


}

function createContactString($id,$imgurl,$friend){
  return "<div class='draggable' uid=$id><div class='contact-image'>
      <img class='profile-pic' src='$imgurl'>
      </div>
      <div class='contact-name'>
      <h5><a href='user.php?id=$id'>$friend</a></h5>
      </div></div>";
}

function removeGroup($conn,$gid){
//first you clear out the grouplist
$sql = "DELETE FROM grouplist WHERE groupID = '$gid'";
mysqli_query($conn,$sql);
$sql = "DELETE FROM userlist WHERE groupID = '$gid'";
mysqli_query($conn,$sql);
//then you clear out the userlist
}

function updateGroupName($conn,$gid,$groupname){
  $sql = "UPDATE `userlist` SET `groupName` = '$groupname' WHERE `userlist`.`groupID` = '$gid'";
  mysqli_query($conn,$sql);
}
//

function renderContestEditorBanner($startTime=0,$endTime=0,$banner="images/banner.png"){
  if($startTime==0){
//    $newDate = date('Y-m-d', strtotime(' + 4 months'));
    $startTime = date("Y-m-d H:i",strtotime(' - 3 month'));
  }
  if($endTime==0){
    $endTime = date("Y-m-d H:i",strtotime(' + 7 days'));
  }
  $str = "  <div id='contest-editor-banner'>
  <h3 style='display:inline;'>Banner</h3>
  <input type='text' id='banner-url' name='banner-url' onchange='changeBannerImg()' placeholder='Optional: Banner URL'>
  <img id='banner-img' src='$banner'>
</div>

<label for='start-time'>Start Time:</label>

<input type='datetime-local' id='start-time'
 name='start-time' value='$startTime'
 min='$startTime'>

 <br>
<label for='deadline'>Deadline:</label>

<input type='datetime-local' id='deadline'
 name='deadline' value='$endTime'
 min='$endTime'>

 <br>
 <label for='deadline'>Capacity (optional):</label>
 <input type='number' name='capacity' placeholder='0' min=0>
 <br>";
echo $str;
return $str;
}
function printUserCard($id,$name,$photo,$loggedin=false,$added=false,$flag=false){
  $card = "<div class='card profile-card'>
    <img src='$photo' class='card-img-top square-img'>
    <div class='card-body'>
      <h5 class='card-title'><a href='user.php?id=$id'>$name</a></h5>";
      if($loggedin&&!$flag){
        $card.=$added?"<button class=cleanbutton onclick='removeContact($id)'><i class='fa-solid fa-user-minus'></i></button>":"<button class=cleanbutton onclick='addContact($id)'><i class='fa-solid fa-user-plus'></i></button>";
      }
      if($flag){
        $card.="<a href='contacts.php'><i class='fa-solid fa-address-book'></i></a>";
      }
    $card .="</div>
  </div>";
  return $card;
}

function showAllUsers($conn,$user=0){
  $loggedin = $user!=0;
  $sql = "select * from usernames";
  $res=mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];
    $name = $row['username'];
    $photo = $row['photo'];
    $flag = $user==$id;
    $added = returnIfAdded($conn,$id,$user);
    //check if current user is connected to session
    $str = $id==0?"":printUserCard($id,$name,$photo,$loggedin,$added,$flag);
    echo $str;
  }

}
function returnIfAdded($conn,$user,$currentUser){
    $sql = "select * from contacts where user1id='$currentUser' and user2id='$user'";
    $res = mysqli_query($conn,$sql);
    return mysqli_num_rows($res)!=0;
}

function renderUserPage($conn,$user,$currentUser=0){
  $sql = "select id,username,photo from usernames where id='$user'";
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);
  $username = $row['username'];
  $photo = $row['photo'];
  $contactButton = "";
  if($currentUser>0){
    $added = returnIfAdded($conn,$user,$currentUser);
    $contactButton = $added?
    "<button class=cleanbutton onclick='removeContact($user)'><i class='fa-solid fa-user-minus'></i></button>"
    :"<button class=cleanbutton onclick='addContact($user)'><i class='fa-solid fa-user-plus'></i></button>";
  
  }$profileView = "<br>
  <div class='user-profile-view'>
    <img src='$photo'>
    <h1>$username</h1>
    <div>$contactButton</div>
  </div>";
  echo $profileView;
  showAllWriting($conn, 3,$user);
}

function contestListItem($cid,$title,$startDate,$registered,$capacity,$description,$endDate,$status,$type){
  //type = 0 contest 1 assignment 2 request?
  $typeStr="";
  switch($type){
    case 0:
      $typeStr="Contest";
      break;
    case 1:
      $typeStr="Assignment";
      break;
    case 2:
      $typeStr="Request";
      break;
    default:
      $typeStr="Error";
  }
  //status = 0 (hasnt started) = 1 (ongoing), 2 (ended)
  $statusStr="";
  switch($status){
    case 0:
      $statusStr="Not Started Yet";
      break;
    case 1:
      $statusStr="Ongoing";
      break;
    case 2:
      $statusStr="Ended";
      break;
    default:
      $statusStr="Error $status";
  }
  $type = createPill($typeStr);
  $statusStr = createPill($statusStr,false);
  $str = "<a href='contest.php?id=$cid' class='list-group-item list-group-item-action flex-column align-items-start active'>
  <div class='d-flex w-100 justify-content-between'>
    <h5 class='mb-1'>$title</h5>
    <small>$startDate</small>
  </div>
  <p>$registered ";
  if($capacity!=0 && $capacity!=null){$str .= "/ $capacity";} 
  $str .= " registered.</p>
  <p class='mb-1'>$description</p>
  <small>$endDate $type $statusStr</small>
</a>";
return $str;
}

function createPill($content,$primaryFlag=true){
  $str = "";
  if($primaryFlag){
$str = "<span class='badge rounded-pill bg-primary'>$content</span>";
  }else{
$str = "<span class='badge rounded-pill bg-dark'>$content</span>";
  }
  return $str;

}

function registerForContest($conn,$cid,$authorID){
  //register
  $sql = "INSERT INTO `contestusers` (`contestID`, `writerID`) VALUES ('$cid', '$authorID')";
  mysqli_query($conn,$sql);
}
function submitContestEntry($conn,$cid,$writing_id,$authorID){
  //entry
  $sql = "INSERT INTO `contestwriting` (`contestID`, `writingID`) VALUES ('$cid', '$writing_id')";
  mysqli_query($conn,$sql);
  //check if author has already registered
  
if(!ifRegisteredToContest($conn,$cid,$authorID)){
  registerForContest($conn,$cid,$authorID);
}
  
}
function ifRegisteredToContest($conn,$cid,$authorID){
  $sql = "select * from contestusers where contestID='$cid' and writerID='$authorID'";
  $res = mysqli_query($conn,$sql);
  return mysqli_num_rows($res)!=0;

}
function ifWrittenToContest($conn,$cid,$authorID){
  $sql = "SELECT * FROM `contestwriting` 
 join writing on writingID=writing.id 
 where contestID='$cid' and authorID='$authorID'";
$res = mysqli_query($conn,$sql);
return mysqli_num_rows($res)!=0;
}
function isContestJudge($conn,$id,$user){
  $sql = "SELECT * FROM `contest` join grouplist on judgeGroup=grouplist.groupID where grouplist.userID='$user' and contest.id='$id'";
  $res = mysqli_query($conn,$sql);
  return mysqli_num_rows($res)!=0;
}
function allowedInContest($conn,$id,$user){
  $sql = "SELECT * FROM `contest` join grouplist on writerGroup=grouplist.groupID where grouplist.userID='$user' and contest.id='$id'";
  $res = mysqli_query($conn,$sql);
  return mysqli_num_rows($res)!=0;
  
}
function isContestEntry($conn,$id){
  $sql = "SELECT * FROM `writing` join contestwriting on writing.id = contestwriting.writingID where writing.id='$id'";
  $res = mysqli_query($conn,$sql);
  return mysqli_num_rows($res)!=0;
}
function getSubCategoryFromContest($conn,$cid){
  $sql = "SELECT subcategoryID,name,subcategory.description as helpstr  FROM `contest` join subcategory on subcategoryID=subcategory.id where contest.id=$cid";
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);
  return $row;
}

function createRatingSliderForUser($conn,$writing_id,$user){
  //function to check if writing is allowed to be judged by the current user.
  //we check if writing status = 3.
  //then we check the contest id the writing is written for.
  //we find host + judge panel for the contest
  //if user exists there, then return the slider.

  $sql = "SELECT * FROM `contestwriting` where writingID=$writing_id";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)==0){
    //printAllFeedback($conn,$writing_id);
    return;}
  $row = mysqli_fetch_assoc($res);
  $cid = $row['contestID'];
  $sql = Contest::getJudgedContests($user)." and contest.id='$cid' ";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)!=0){
    createRatingSlider($writing_id,$cid,$user,$conn);
  }else{
    echo printAllFeedback($conn,$writing_id);
  } //something happens if there entries.
}

function createRatingSlider($writing_id,$contest_id,$user,$conn){
//get the values for the range and feedback from $user and $conn
  $sql = "select * from marks where writingID='$writing_id' and judgeID='$user'";
  $res = mysqli_query($conn,$sql);
    $flag = mysqli_num_rows($res)==0;
    $row = mysqli_fetch_assoc($res);
    $score = $flag?5:$row['score'];
    $feedback = $flag?"":$row['feedback'];
  $str = "<form action='function/markWriting.php' method='post'>
  <input type='hidden' name='wid' value='$writing_id'>
  <input type='hidden' name='cid' value='$contest_id'>
  <label>Score: (between 0 to 10)</label>
  <input type='range' class='form-range' min='0' max='10' step='1' value='$score' name='marks'>
  <textarea style='margin-bottom: 2%;' class='form-control' name='feedback' placeholder='leave feedback'>$feedback</textarea>
  <input type='submit' class='btn btn-primary' value='Mark'>";

  echo $str.printAllFeedback($conn,$writing_id);
}

function printAllFeedback($conn,$writing_id){
  $sql = "SELECT * FROM `marks` join usernames on marks.judgeID=usernames.id where writingID='$writing_id'";
  $res = mysqli_query($conn,$sql);
  $str = "<h2
  style='padding-top: 6%;
  border-top: 1px solid lightgray;
  margin-top: 8%;'
  >Feedback:</h2>";
  $flag = true;
  while($row = mysqli_fetch_assoc($res)){
    $judge = $row['username'];
    $judgeID=$row['judgeID'];
    $score = $row['score'];
    $feedback = $row['feedback'];
    $str .= printFeedback($judge, $judgeID, $score, $feedback);
    $flag = false;
  }
  return $flag?"No feedback yet.":$str;

}

function printFeedback($judge, $judgeID, $score, $feedback=""){
  $str = "<div class='row'>
  <div class='col-2'><h1>$score</h1></div>
  <div class='col-10'><figure>
  <blockquote class='blockquote'>
    <p class='mb-0'>$feedback</p>
  </blockquote>
  <figcaption class='blockquote-footer'>
    <a href='$judgeID'>$judge</a>
  </figcaption>
</figure></div>
</div>";
return $str;
}

function printContestEntry($obj){

  //$obj->contestID;
  $id = $obj->writeID;
  $aid = $obj->authorID;
  $marks = $obj->marks;
  $title = $obj->title;
  $blurb = $obj->blurb;
  //$author = $obj->author;
  //$obj->readtime;
  $str = "<a href='work.php?id=$id' class='list-group-item list-group-item-action flex-column align-items-start active'>
            <div class='d-flex w-100 justify-content-between'>
              <h5 class='mb-1'>$title</h5>";
              //<small><button href='user.php?id=$aid'>Author</button></small>
            $str .= "</div>
            <p class='mb-1'>$blurb</p>
            <small>Score: $marks</small>
          </a>";

  //$str="";
  return $str;
}

function createNavElement($href, $name,$icon){
  //<li><a class="nav-link" aria-current="page" href="index.php">Home</a></li>
  //home
  //editor
  //contests
  //contacts (will be in user page)
  //all users 
  //<i class="fa-solid fa-pen-nib"></i>
  //$icon = house , pen-to-square , book,  pen-nib
  $icons = ['house','pen-to-square','book','pen-nib'];
  $str = "<li class='navItem'><a class='nav-link' aria-current='page' href='$href'>
  <div class='navIcon'><i class='fa-solid fa-$icons[$icon]'></i></div>
  <div class='navIconTitle'>$name</div>
  </a></li>";
  return $str;
}

function createUserDropdown($conn,$id){
  //<img class='profile-pic' src='$imgurl'>
  $sql = "select id,username,photo from usernames where id='$id'";
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);
  $username = $row['username'];
  $photo = $row['photo'];
  $image = "<img class='profile-pic2' src='$photo'>";
  $str = "<li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle profileButton' data-bs-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>$image $username</a>
          <div class='dropdown-menu'>
            <a class='dropdown-item' href='user.php'>User Page</a>
            <a class='dropdown-item' href='contacts.php'>Contacts</a>
            <a class='dropdown-item' href='users.php'>User List</a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='discover.php'>Host a Contest</a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='function/logout.php'>Log Out</a>
          </div>
        </li>";
        return $str;
}

function returnScoreList($conn,$id){
  $arr = array_fill(0,11,0);
  $sql = "select ceil(t1.marks) as score,count(t1.id) as contestants from (SELECT id,avg(score) as marks
       FROM `contestwriting` 
      join writing on writingID=writing.id 
      left join marks on contestwriting.writingID=marks.writingID 
      where contestID='$id' group by contestwriting.writingID)t1 group by ceil(t1.marks)";
      $res = mysqli_query($conn,$sql);

      while($row = mysqli_fetch_assoc($res)){
        $x = $row['score'];
        $y = $row['contestants'];
        $arr[$x]=$y;
      }
      
      return str_replace('"', '', json_encode($arr));


}

function returnTextFromWriting($conn,$id){
  $sql ="SELECT body FROM `writing` where id='$id' ";
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);
  $body = $row['body'];
  return $body;
}
function allowedToHost($conn,$id){
  $sql = "SELECT canHost FROM `usernames` where id = '$id'";
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($res);
  $canHost = $row['canHost'];
  return $canHost;
  }
  
 
?>


