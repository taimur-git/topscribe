<?php include('partial/navbar.php');?>
<?php
$user = isset($_SESSION['id'])?$_SESSION['id']:-1;
$page = isset($_GET['id'])?$_GET['id']:$user;

if($user == $page){
    //if user goes to their own page:
        //keep this for now.
    //renderUserPage($conn,$page,$user);



    

echo "<div class='accordion' id='accordionParent'>";
echo createAccordionItem(1,"Own writings",showAllWriting($conn, 3,$user,'' , 0, 1, 0,false));
echo createAccordionItem(7,"Private writings",showAllWriting($conn, 4,$user,'' , 0, 1, 0,false));
echo createAccordionItem(2,"Bookmarks",showAllWriting($conn, 2,$user,'' , 0, 1, 0,false));
echo createAccordionItem(3,"Contest Entries",showAllWriting($conn, 5,$user,'' , 0, 1, 0,false));
/*
echo "<h2>--Under construction--</h2>";
echo createAccordionItem(4,"Registered Contests","");
echo createAccordionItem(5,"Hosted Contests",renderContestListView($conn,$user,));
echo createAccordionItem(6,"Judging Contests",renderContestListView($conn,$user,false));
*/
echo "</div>";














}else{
    //any other user's page.
    //see their profile, add them, and see all their writings and hosted contests.
    renderUserPage($conn,$page,$user);
}


function createAccordionItem($i,$header,$content,$parent="accordionParent"){
    return "<div class='accordion-item'>
  <h2 class='accordion-header' id='heading-$i'>
    <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse-$i' aria-expanded='false' aria-controls='collapse-$i'>
      $header
    </button>
  </h2>
  <div id='collapse-$i' class='accordion-collapse collapse' aria-labelledby='heading-$i' data-bs-parent='#$parent'>
    <div class='accordion-body'>
      
$content
    
    </div>
  </div>
</div>";
}
?>
<?php include('partial/footer.php');?>