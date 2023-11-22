<?php
$page_name="Submissions";
require("menu.php");
require("header.php");
?>


<main class="main-content position-relative border-radius-lg">
    
    <div class="container-fluid py-4">

      <!-- Outer row -->
      <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4 " style="margin-top:-50px">

<div id="space"></div>
<div class="row">
          <div class="col-lg-12 mb-lg-0 mb-4 mt-4 ">
            <div class="card z-index-2 h-70" style="min-width: 2100px !important;">
              <div class="card-body p-3">
<?php
    create_table_no_limit();
    if(!isset($_POST["search"]))
    {
        create_data_no_limit();
    }
    else
    {
        // echo "test123".$_POST["search"];
            create_search_data($_POST["search"]);
    }
    
    
?>

</div>
    </div>

          
    </div>
</div>


</div>
    </div>

          
    </div>
  </main>



<?php

require("footer.php");
?>