<?php
include('constant.php');

//echo "test";
?>
<style>
  body{
    background: linear-gradient(90deg,rgba(0, 0, 1, 0.9), rgba(88, 86, 86, 0.7)), url('images/article_pic2.jpg');
    background-repeat: no-repeat;
    background-size: cover;
  }
  </style>
<div class="card text-white bg-primary mb-3 text-white2">
  <div class="card-header"><h2><?php countUser($conn);?></h2></div>
  <div class="card-body">
    <h5 class="card-title">Total users</h5>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
  </div>
</div>

<div class="card text-white bg-primary mb-3 text-white2">
  <div class="card-header"><h2><?php countContest($conn);?></h2></div>
  <div class="card-body">
    <h5 class="card-title">Total Contests</h5>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
  </div>
</div>

<div class="card text-white bg-primary mb-3 text-white2">
  <div class="card-header"><h2><?php countArticle($conn);?></h2></div>
  <div class="card-body">
    <h5 class="card-title">Total Articles</h5>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
  </div>
</div>



<?php
//view topics , remove topics
//view contest, edit name and description
//view, delete, privatise writing
//view, delete users
//***category create, update, delete, view + subcategory create update delete view
//***admin approve contest, approve person for further contest
/*
viewCategory($conn);
viewSubCategory();
viewContests();
*/

?>