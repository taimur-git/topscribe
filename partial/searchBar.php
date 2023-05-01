<div class='filter-input'>
<div class="input-group rounded">
  <input type="search" class="form-control rounded" placeholder="Search: title, topics, username, subcategory" aria-label="Search" aria-describedby="search-addon" id='searchTerm' oninput="renderView()"/>
  

  
</div>
<div class="input-group">
      <label for="orderSelect" class="form-label mt-4">Order by:</label>
      <select class="form-select" id="orderSelect" onchange='renderView()'>
        <option value='0'>---</option>
        <option value='1'>date</option>
        <option value='2'>view</option>
        <option value='3'>bookmarks</option>
        <option value='4'>read time</option>
      </select>
      <select class="form-select hidden" id="sortSelect" onchange='renderView()'>
        <option value='2'>descending</option>
        <option value='1'>ascending</option>
        
      </select>
    </div>
</div>

    <?php

    //include('rangeSlider.php');
    //document.querySelector("#exampleSelect2").selectedOptions 
    ?>