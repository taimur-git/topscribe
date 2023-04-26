<?php
include('constant.php');
include('apikey.php');
require '../vendor/autoload.php';
    $authorID = $_SESSION['id'];
    $title = $_POST['title'];
    $body= $_POST['body'];
    $subcategory = $_POST['subcategory'];
    $topics = $_POST['topics'];
    $privacy = $_POST['audience'];
    $auto = isset($_POST['autogen']);
    $topicArr = array();
if($auto){
    TextRazorSettings::setApiKey($text_razor_api_key);

    $text = $body;
    $i = 0;
    $textrazor = new TextRazor();
    
    $textrazor->addExtractor('topics');
    
    $response = $textrazor->analyze($text);
    if (isset($response['response']['topics'])) {
        foreach ($response['response']['topics'] as $topic) {
            if($topic['score'] > 0.99 || $i < 3){
                array_push($topicArr,strtolower($topic['label']));
                $i = $i + 1;
            }
            
        }
    }
}else{
    $topicArr = json_decode($topics);
}
    
    

	//0 - publish 1 - anonymous 2 - hidden 3 - draft
    $writing_id = publishWriting($conn,$title,$body,$authorID,$privacy,$subcategory);
    addTopicArr($conn,$topicArr,$writing_id);
    //header("Location: ../index.php");
    header("Location: ../work.php?id=$writing_id");
?>