<?php include('partial/navbar.php');
include('admin/constant.php');
?>



<table class="table table-hover">
    <tr class="table-dark">
      <th scope="row">ID</th>
      <td>Category</td>
      <td>Sub-Category</td>
      <td>Description</td>
      <td>Action</td>
    </tr>
    <?php
    $sql = "SELECT subcategory.id,subcategory.catid, category.name as category,  subcategory.name as subcategory, subcategory.description FROM subcategory LEFT JOIN category on subcategory.catid=category.id";
    $query = mysqli_query($conn, $sql);
    while ($info = mysqli_fetch_array($query)) {
        // $id=$info[''];
        $sel_cat;
        $cat = $info['catid'];
        $sub_cat=$info['id'];
        
        ?>
            <tr >
                
                <td>                    <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">

                    <?php echo $info['id'] ?></td>
                <td>
                    <?php
                        $sql1 = "SELECT id,category.name FROM category"  ;
                        $query1 = mysqli_query($conn,$sql1);
                        while ($data = mysqli_fetch_array($query1))
                        {
                            if($data['id']==$cat){
                                echo $data['name'];
                            }
                        }

                    ?> 
                                        <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">

                </td>
                <form action="" method="post">

                <td>
                <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">

                    <?php
                        $sql2 = "SELECT id,subcategory.name FROM subcategory"  ;
                        $query2 = mysqli_query($conn,$sql2);
                        while ($data1 = mysqli_fetch_array($query2))
                        {
                            if($data1['id']==$sub_cat){
                                ?>
                                <input name="sub_name" type="text" class="form-control" id="inputDefault" fdprocessedid="52jcu" value="<?php echo $data1['name'] ?>">
                                <?php
                            }
                        }
                        
                    ?>

                </td>
                <td>

                    <textarea name="discrip" id="" cols="80" rows="6"><?php echo $info['description'] ?></textarea>
                    <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">

                </td>
                <td>
                    <input  type="submit" name="button" value="Update" class ="btn btn-outline-info" ></form>
                    <input type="hidden" name="cat_id" value="<?php echo $info['id'] ?>">

                    </form>
                    <!-- <a id="update" href="admin_catagory_update.php?id=<?= $info['id'] ?>&dis=<?= $info['name'] ?> " class ="btn btn-outline-info">Delete</a> -->
                    <a id="del" onclick="return checkdelete()" href="admin_catagory_delete.php?id=<?= $info['id'] ?>" class ="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
<?php

    }
    ?>

</table>




<?php 
    if(isset($_POST['button'])){
        $val = $_POST['discrip'];
        $idnum=$_POST['cat_id'];
        $subname=$_POST['sub_name'];

        $sql4="UPDATE `subcategory` SET subcategory.description='$val',subcategory.name='$subname' WHERE id='$idnum'";
        $query4 = mysqli_query($conn,$sql4);
        if($query4){
            echo "<script>alert('Record Updated on Database')</script>";
            // echo($subname);
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL=
            http://localhost/topscribe/admin_catagory.php">
            <?php
        }
    }
?>

<script>
        function checkdelete()
        {
            return confirm('Are you sure you want to Delete this Record');
        }
</script>


<?php include('partial/footer.php');?>
