<?php include('partial/navbar.php');
include('admin/constant.php');
?>



<table class="table table-hover">
    <tr class="table-dark">
      <th scope="row">ID</th>
      <td>User Name</td>
      <td>Total writing</td>
      <td>Action</td>
    </tr>
    <?php
    $sql = "SELECT usernames.id,usernames.username, COUNT(writing.authorID) FROM `usernames`
    LEFT JOIN writing ON usernames.id = writing.authorID
    WHERE usernames.id !=0
    GROUP by usernames.id";
    $query = mysqli_query($conn, $sql);
    while ($info = mysqli_fetch_array($query)) {
        ?>
            <tr >
                <td><?php echo $info['id'] ?></td>
                <td><?php echo $info['username'] ?></td>
                <td><?php echo $info['COUNT(writing.authorID)'] ?></td>
                <td><a id="del" onclick="return checkdelete()" href="admin_delete.php?id=<?= $info['id'] ?>" class ="btn btn-outline-danger">Delete</a></td>
            </tr
<?php

    }
    ?>

</table>
<script>
        function checkdelete()
        {
            return confirm('Are you sure you want to Delete this Record');
            
        }
</script>



<?php include('partial/footer.php');?>

