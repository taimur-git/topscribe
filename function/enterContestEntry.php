<?php
include('constant.php');
    $cid = $_POST['cid'];
    $authorID = $_SESSION['id'];
    $title = $_POST['title'];
    $body= $_POST['body'];
    $subcategory = $_POST['subcategory'];//subcategory will be fixed.
    $topics = $_POST['topics'];
    $privacy = 3;//privacy will be private.

    $topicArr = json_decode($topics);

    

	//0 - publish 1 - anonymous 2 - hidden 3 - draft
    $writing_id = publishWriting($conn,$title,$body,$authorID,$privacy,$subcategory);
    addTopicArr($conn,$topicArr,$writing_id);
    submitContestEntry($conn,$cid,$writing_id,$authorID);
    //header("Location: ../index.php");
    header("Location: ../work.php?id=$writing_id");
?>