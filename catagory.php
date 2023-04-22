<?php include('partial/navbar.php');
include('admin/constant.php');
// include('function/constant.php');
?>
<table class="table table-hover">
    <tr class="table-dark">
      <th scope="row">ID</th>
      <td>Category</td>
      <td>Default Sub-Category</td>
      <td>Action</td>
      
    </tr>
    <?php
    $sql = "SELECT category.id, category.name,category.defaultID, subcategory.name as scname from category left join subcategory on category.defaultID=subcategory.id";
    $query = mysqli_query($conn, $sql);
    while ($info = mysqli_fetch_array($query)) {

        $catDefaultID = $info['defaultID'];
        $catID=$info['id'];
        
        ?>
            <tr >
            <form action="" method="post">

                <td><p name="idnum"><?php echo $info['id'] ?></p>
                    </td>
                    <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">
                <td>

                    <input name="cat" type="text" class="form-control"  id="inputDefault" fdprocessedid="52jcu" value="<?php echo $info['name'] ?>">
                    <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">   
                </td>
                <td>
                    
                    <?php
                      $sql = "SELECT id,name FROM `subcategory` WHERE catid ='$catID'"  ;
                      $res = mysqli_query($conn,$sql);
                      ?>
                      <select name="defaultID" >
                        <?php
                      while($data= mysqli_fetch_assoc($res)){
                        ?>
                            <option value= <?php echo $data['id'] ?> <?php if($catDefaultID == $data['id']){echo "selected";} ?>><?php echo $data['name'] ?></option>
                        <?php
                      }
                ?>
                </select>

                    <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">
                </td>

                 
                <td>

                    <input  type="submit" name="button" value="Update" class ="btn btn-outline-info" >
                    <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">
   
                </form>   
                   
                </td>
            </tr>
<?php

    }
    ?>

</table>

<a href="addNewCatagory.php" id="addCat" class="btn btn-success">Add Category</a>

<?php 
    if(isset($_POST['button'])){
        $cat_id = $_POST['cat_id'];

        $val = $_POST['cat'];

        $defID=$_POST['defaultID'];

        $sql4="UPDATE `category` SET category.name='$val', category.defaultID='$defID' WHERE category.id ='$cat_id'";
        $query4 = mysqli_query($conn,$sql4);
        if($query4){
            echo " <script>alert(' Record Updated on Database')</script>";
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


<?php include('partial/footer.php');?>
