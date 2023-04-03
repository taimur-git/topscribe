<?php
echo "test";
//view topics , remove topics
//view contest, edit name and description
//view, delete, privatise writing
//view, delete users
//***category create, update, delete, view + subcategory create update delete view
//***admin approve contest, approve person for further contest
function createCategory($conn,$name){
    $sql = "insert into category (name) values ('$name')";
    //if we are using the defaultsubcategory, then:
        //keep the default as null
        //once a new subcategory is made for this category, we check if it has a null default subcategory
        //if it does, we set the new subcategory as the default.

}
function updateCategory($conn,$name,$id){//},$defaultID){
    $sql = "update category set name='$name' where id='$id'";//name='$name', defaultID='$defaultID'
}
//function deleteCategory(){}
function viewCategory($conn){
    $sql = "select * from category";
    //show the categories with html.
}

function createSubSategory($conn,$name,$description,$catID=1){
    $sql = "insert into subcategory (name,description,catid) values ('$name','$description','$catID')";
}
function updateSubCategory(){}
function deleteSubCategory(){}
function viewSubCategory(){}

function approveContest($conn,$contestID){
    $sql = "update contest set accepted=1 where id='$contestID'";
}
function approveAllForUser($conn,$userID){
    $sql = "update contest set accepted=1 where hostID='$userID'";
}
function approveFuture($conn,$userID){
    $sql = "update usernames set canHost=1 where id='$userID'";
    /*
    
    */
    approveAllForUser($conn,$userID);
}
function viewContests(){}

?>