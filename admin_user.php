<?php include('partial/navbar.php');
include('admin/constant.php');
?>



<table class="table table-hover">
    <tr class="table-dark">
      <th scope="row">ID</th>
      <td>User Name</td>
      <td>Photo</td>
      <td>Number of content</td>
      <td>Action</td>
    </tr>
    <?php
    $sql = "SELECT `id`, `username`,  `photo` FROM `usernames` WHERE id !=0";
    $query = mysqli_query($conn, $sql);
    while ($info = mysqli_fetch_array($query)) {
        ?>
            <tr >
                <td><?php echo $info['id'] ?></td>
                <td><?php echo $info['username'] ?></td>
                <td><a id="del" href="delete.php?id=<?= $info['id'] ?>" class ="btn btn-outline-danger">Delete</a></td>


                <!-- <td><?php echo $info['photo'] ?></td> -->
                <!-- <td><img src="<?php echo $info['photo'] ?>" alt="" width="1%"></td> -->

            </tr
<?php

    }
    ?>

</table>



<?php include('partial/footer.php');?>

