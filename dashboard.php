<?php
$page_name="Dashboard";
require("menu.php");
require("header.php");
?>





  <main class="main-content position-relative border-radius-lg ">
    
    <div class="container-fluid py-4">

      <!-- Outer row -->
      <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4 " style="margin-top:-50px">
          <?php
            create_fields_new();
          ?>
         

         <!-- Inner row -->
         <div class="row">
          <div class="col-lg-12 mb-lg-0 mb-4 mt-4 ">
            <div class="card z-index-2 h-70">
              <div class="card-body p-3">
                
                <textarea rows="8" cols="52" id="search_result">Hello,

                  This is Neiv, I am a web security researcher and I was surfing the internet and found your website asdasdasdasd and as I was checking your website
                   I found a vulnerability on your website which I would very much like to disclose to you responsibly so that you can fix that vulnerability
                    and be safe from cyber attacks that could hurt you and your client base. Please provide your tech support email so that I can send the complete 
                    vulnerability report along with possible solutions.

                  Thank you</textarea>


          </div>
        </div>
      </div>
        </div>
        </div>

        
        <div class="col-lg-6 mb-lg-0 mb-4 ">
          
          <div class="card z-index-2 h-70">
            <div class="card-body p-3">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-4">
                    <h4 color="black">Reports</h4>
                    <p color="black">50 Total</p>
                  </div>
                  <!-- <div class="col-md-2 my-auto">
                    <button type="submit" class="btn btn-primary5">Select All Report</button>
                  </div> -->
                  
                    
                  <div class="col-md-8 my-auto">
                    <button type="submit" id="export_to_csv" class="btn btn-primary5">Download Reports</button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">           
                <?php
                    create_table();
                    create_data();
                ?>
              </div>
              
              
    
        </div>
        <div class="col-md-12 text-right px-3">
                
          <!-- <button type="submit" class="btn btn-primary6" id="clear_table">Clear All Report</button> -->
        </div>
      </div></div>
      </div>
    </div>

          
    </div>
  </main>
  


<script>
  // $("#table_of_items tr").remove(); 
    document.getElementById("export_to_csv").onclick=function()
    {
      $('table').csvExport();
    }
    var reports="";
    function removeHttp(url) {
        return url.replace(/^https?:\/\//, '');
    }
    $('#check_website').click(function (e) {
        
        e.preventDefault();
        
        // var url = $(this).attr("action");
        var url="search_data.php";
        $.ajax({
        type: 'POST',
        url: url,
        data: $('#search_form').serialize(),
        dataType : 'json', 
        success: function (data) {
          
            $("#check_tested").html(data);
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        })
    
    });
    $('#generate_report').click(function (e) {
        
        e.preventDefault();
        
        // var url = $(this).attr("action");
        var url="create_report.php";
        $.ajax({
        type: 'POST',
        url: url,
        data: $('#search_form').serialize(),
        dataType : 'json', 
        success: function (data) {
          // console.log(data);
            $("#search_result").html(data);
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        });
    
    });
    $('#copy_report').click(function (e) {
        
        e.preventDefault();
        
        var copyText = document.getElementById("search_result");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value);
    
    });
    $('#submit_report').click(function (e) {
        
        e.preventDefault();
        
        // var url = $(this).attr("action");
        var url="submit_report.php";
        $.ajax({
        type: 'POST',
        url: url,
        data: $('#search_form').serialize(),
        dataType : 'json', 
        success: function (data) {
            $("#check_tested").html(data);
            $("#search_form")[0].reset();
            // document.getElementById('tbody-zia').remove();
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        });
    
    });
</script>






<?php

require("footer.php");
?>