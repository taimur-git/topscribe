<?php include('partial/navbar.php');
include('admin/constant.php');
?>

<!-- <div class="form-group">
  <label class="col-form-label mt-4" for="inputDefault">Default input</label>
  <input type="text" class="form-control" placeholder="Default input" id="inputDefault" fdprocessedid="52jcu">

  <label class="col-form-label mt-4" for="inputDefault">Default input</label>
  <input type="text" class="form-control" placeholder="Default input" id="inputDefault" fdprocessedid="52jcu">
</div> -->

<form action="" method="POST">
  <fieldset>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Category</label>
      <input name="cate" type="text" class="form-control"  id="inputDefault" fdprocessedid="52jcu" placeholder="Enter new category" value="">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Sub-Category</label>
      <input name="sub_category" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
        placeholder="Enter default sub-category" fdprocessedid="rymkc3">


    </div>
    <div class="form-group">
      <label for="exampleInputEmail1" class="form-label mt-4">Sub-Category discriptoion</label>
      <textarea name="discrip" class="form-control" id="" rows="6" placeholder="Description"></textarea>
    </div>
    <div class="form-group">
      <br>
      <input type="submit" name="button" value="Submit" class="btn btn-outline-info">

    </div>

  </fieldset>
</form>

<?php 
    if(isset($_POST['button'])){
      $cate = $_POST['cate'];
      $sub_category = $_POST['sub_category'];
      $discrip=$_POST['discrip'];

      $sql_cat_id = "SELECT category.id as new_cat_id from category ORDER BY id DESC LIMIT 1";
      $query0 = mysqli_query($conn,$sql_cat_id);
      $cat_id = mysqli_fetch_array($query0);
      $idofcat=$cat_id['new_cat_id']+1;

      $sql_sub_cat_id="SELECT subcategory.id as new_sub_cat_id from subcategory ORDER BY id DESC LIMIT 1";
      $query1 = mysqli_query($conn,$sql_sub_cat_id);
      $sub_cat_id = mysqli_fetch_array($query1);
      $idofsubcat=$sub_cat_id['new_sub_cat_id'] +1;



      $sql="INSERT INTO category(category.id, category.name, category.defaultID) VALUES ('$idofcat','$cate','$idofsubcat')";
      $query2 = mysqli_query($conn,$sql);

      $sql_sub_cat="INSERT INTO subcategory(subcategory.id, subcategory.catid, subcategory.name, subcategory.description) VALUES ('$idofsubcat','$idofcat','$sub_category','$discrip')";
      $query3 = mysqli_query($conn,$sql_sub_cat);


      if($query3){
        echo "<script>alert('New category has been added')</script>";
        ?>
        <META HTTP-EQUIV="Refresh" CONTENT ="0; URL=
        http://localhost/topscribe/catagory.php">
        <?php
      }
      else{
          echo"Failed for defaultID";
      }



    }

?>
<?php include('partial/footer.php'); ?>