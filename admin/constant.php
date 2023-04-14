<?php

function viewCategory($conn){
    $sql = "select * from category";
    //show the categories with html.
    //will be able to update existing categories and make new categories.
    /*
    updateCategory()
    createCategory()
     */
    
}


function viewSubCategory(){
    /*
    createSubCategory()
    updateSubCategory()
    deleteSubCategory()
    */
}



function viewContests(){
    /*
    approveAllForUser()
    approveContest()
    approveFuture()
    */
}




function countUser($conn){
    $sql="SELECT COUNT(id) AS total FROM usernames
    where id!=0";
    $query = mysqli_query($conn,$sql);
    $value = mysqli_fetch_assoc($query);
    echo($value['total']);
}

function countContest($conn){
    $sql="SELECT COUNT(id) AS total FROM contest WHERE accepted = 1";
    $query = mysqli_query($conn,$sql);
    $value = mysqli_fetch_assoc($query);
    echo($value['total']);
}

function countArticle($conn){
    $sql="SELECT COUNT(id) AS total FROM writing ";
    $query = mysqli_query($conn,$sql);
    $value = mysqli_fetch_assoc($query);
    echo($value['total']);
}



function createCategory($conn,$name){
    $sql = "insert into category (name) values ('$name')";
    mysqli_query($conn,$sql);
}
function updateCategory($conn,$name,$id,$defaultID){
    $sql = "update category set name='$name',defaultID='$defaultID' where id='$id'";
    mysqli_query($conn,$sql);
}
function addDefaultID($conn,$id,$defaultID){
    $sql = "update category set defaultID='$defaultID' where id='$id'";
    mysqli_query($conn,$sql);
}
//function deleteCategory(){}


function createSubCategory($conn,$name,$description,$catID=1){
    $sql = "insert into subcategory (name,description,catid) values ('$name','$description','$catID')";
    mysqli_query($conn,$sql);
    $subid = mysqli_insert_id($conn);
    if(!defaultExists($conn,$catID)){
        addDefaultID($conn,$catID,$subid);
    }
    return $subid;
}

function defaultExists($conn,$catID,$return=false){
    $sql = "select defaultID from category where id='$catID'";
    $res=mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $default = $row['defaultID'];
    if($return){
        return $default;
    }else{
        return $default!=0;
    }
  }
function isDefault($conn,$subID){
    $sql = "select * from category where defaultID='$subID'";
  $res=mysqli_query($conn, $sql);
  return mysqli_num_rows($res)!=0;
}
function returnCategory($conn,$subID){
$sql = "select catid from subcategory where id='$subID'";
$res=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$catID = $row['catid'];
return $catID;

}

function updateSubCategory($conn,$id, $name,$description,$catID=1){
    $sql = "update subcategory set name='$name',description='$description',catid='$catID' where id='$id'";
    mysqli_query($conn,$sql);
}
function updateWritingSubCategory($conn,$originalID,$newID){
    $sql = "update writing set subcategoryID='$newID' where subcategoryID='$originalID'";
    mysqli_query($conn,$sql);
}
function updateContestSubCategory($conn,$originalID,$newID){
    $sql = "update contest set subcategoryID='$newID' where subcategoryID='$originalID'";
    mysqli_query($conn,$sql);
}
function deleteSubCategory($conn,$subID){
    //cannot delete if it is the default subcategory.
    if(!isDefault($conn,$subID)){
        //before deleting the subcategory, change all the existing writings and contests to default subcategory.
        $catID = returnCategory($conn,$subID);
        $defaultID = defaultExists($conn,$catID,true);
        updateContestSubCategory($conn,$subID,$defaultID);
        updateWritingSubCategory($conn,$subID,$defaultID);
        $sql = "delete from subcategory where id='$subID'";
        return mysqli_query($conn,$sql);
    }
}

function approveContest($conn,$contestID){
    $sql = "update contest set accepted=1 where id='$contestID'";
    mysqli_query($conn,$sql);
}
function approveAllForUser($conn,$userID){
    $sql = "update contest set accepted=1 where hostID='$userID'";
    mysqli_query($conn,$sql);
}
function approveFuture($conn,$userID){
    $sql = "update usernames set canHost=1 where id='$userID'";
    mysqli_query($conn,$sql);
    approveAllForUser($conn,$userID);
}

function deleteUnusedTopics($conn){
    //finds topics that dont exist in topicwriting
    //deletes them.
}
function deleteUnusedGroups($conn){
    //finds groups that dont contain any contacts
    //deletes them
}
function cleanDatabase($conn){
    deleteUnusedTopics($conn);
    deleteUnusedGroups($conn);
}
?>