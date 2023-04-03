<?php
include('constant.php');

echo "test";
//view topics , remove topics
//view contest, edit name and description
//view, delete, privatise writing
//view, delete users
//***category create, update, delete, view + subcategory create update delete view
//***admin approve contest, approve person for further contest

viewCategory($conn);
viewSubCategory();
viewContests();


?>