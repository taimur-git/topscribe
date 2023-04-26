<style>
    body{
        overflow-x: clip;
    }
</style>
  <div class="row">
    <div class="col" id='particles-js'>
        
    </div>
    <div class="col-8">
    <?php
        include('partial/searchBar.php');
        echo "<div id='touchThis'>";
        showAllWriting($conn);
        echo "</div>";
    ?>
    </div>
    <div class="col" id='particles-js2'>
        
    </div>