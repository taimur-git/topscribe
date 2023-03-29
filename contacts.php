<?php include('partial/navbar.php');?>
<div class='wrapper'>

<?php 
$user = $_SESSION['id'];
viewContacts($conn,$user);
?>

<div id='right' class='drag-section'>
  <div>test3</div>
</div>

<div id='right1' class='drag-section'>
  <div>test4</div>
</div>

<div id='right2' class='drag-section'>
  <div>test3</div>
</div>

<div id='right3' class='drag-section'>
  <div>test4</div>
</div>

</div>

<script src='scripts/dragula.min.js'></script>
<script src='scripts/contacts.js'></script>
<?php include('partial/footer.php');?>