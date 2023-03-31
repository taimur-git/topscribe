<?php include('partial/navbar.php');?>
<div class='wrapper'>

<?php 
$user = $_SESSION['id'];
viewContacts($conn,$user);
//limit 4 groups per user?
viewGroups($conn,$user);
?>
</div>
<div>
  <label for=group></label>
  <input type='text' name='group' id='group-name' placeholder='Group Name'></input>
  <button type='button' class=cleanbutton onclick='addGroup()'><i class='fa-solid fa-plus'></i></button>
</div>


<?php include('partial/footer.php');?>
<script src='scripts/dragula.min.js'></script>
<script src='scripts/contacts.js'></script>