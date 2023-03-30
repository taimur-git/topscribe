<?php
include('constant.php');

    $authorID = $_SESSION['id'];
    $title = $_POST['title'];
    $body= $_POST['body'];
    $subcategory = $_POST['subcategory'];
    $topics = $_POST['topics'];
    $privacy = $_POST['audience'];

    $topicArr = json_decode($topics);

    

	//0 - publish 1 - anonymous 2 - hidden 3 - draft
    $writing_id = publishWriting($conn,$title,$body,$authorID,$privacy,$subcategory);
    addTopicArr($conn,$topicArr,$writing_id);
    //header("Location: ../index.php");
    header("Location: ../work.php?id=$writing_id");
?>