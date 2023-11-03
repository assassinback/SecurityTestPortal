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
                
                <textarea rows="10" cols="68" id="search_result">

                 </textarea>


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
                    <style>.col-md-8.my-auto {
                        display: flex;
                        flex-direction: row;
                        align-content: flex-end;
                        justify-content: flex-end;
                    }</style>
                    <button type="submit" id="copy_all_reports" class="btn btn-primary5">Copy Reports</button>
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
             <style>.col-md-12.text-right.px-3 {
                display: flex;
                flex-direction: row;
                justify-content: flex-end;
                margin-left: -15px;
            }</style>
         <button type="submit" class="btn btn-primary6" id="clear_table">Clear All Report</button> 
        </div>
      </div></div>
      </div>
    </div>

          
    </div>
  </main>
  


<script>
  // $("#table_of_items tr").remove(); 
    // document.getElementById("export_to_csv").onclick=function()
    // {
    //   $('table').csvExport();
    // }
    // var reports="";
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
            
            setTimeout(function() { $("#check_tested").html(""); }, 5000);
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
    $('#clear_table').click(function (e) {
        
        e.preventDefault();
        
        // var url = $(this).attr("action");
        var url="clear_table.php";
        $.ajax({
        type: 'POST',
        url: url,
        data: $('#search_form').serialize(),
        dataType : 'json', 
        success: function (data) {
          // console.log(data);
          $("#check_tested").html(data);
          document.getElementById("table_of_items").innerHTML="";
          setTimeout(function() { $("#check_tested").html(""); }, 5000);

        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        });
    
    });
    $('#copy_email').click(function (e) {
        
        e.preventDefault();
        
        var copyText = document.getElementById("inputEmail4");

        copyText.select();
        // copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value);
    
    });
    $('#copy').click(function (e) {
        
        e.preventDefault();
        
        var copyText = document.getElementById("sub4");

        copyText.select();
        // copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value);
    
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
            if(data=="Please Enter Website Link")
            {
                $("#check_tested").html(data);    
            }
            else
            {
                data=Object.entries(data);
                $("#check_tested").html("Data Inserted");
                // $("#check_tested").html(data[0][1]);
                document.getElementById("table_of_items").innerHTML+="<tr><td>"+data[6][1]+"</td><td>"+data[0][1]+"</td><td>"+data[1][1]+"</td><td>"+data[3][1]+"</td><td>"+data[2][1]+"</td></tr>";
                $("#search_form")[0].reset();
                $("#search_result").html("");
                // document.getElementById('tbody-zia').remove();    
            }
            
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        });
    
    });
    function selectElementContents(el) {
        var body = document.body, range, sel;
        if (document.createRange && window.getSelection) {
            range = document.createRange();
            sel = window.getSelection();
            sel.removeAllRanges();
            try {
                range.selectNodeContents(el);
                sel.addRange(range);
            } catch (e) {
                range.selectNode(el);
                sel.addRange(range);
            }
            document.execCommand("copy");

        } else if (body.createTextRange) {
            range = body.createTextRange();
            range.moveToElementText(el);
            range.select();
            range.execCommand("Copy");
        }
    }
    $("#copy_all_reports").click(function (e) {
    
      selectElementContents(document.getElementById('export'));
    });
    
</script>




    



<?php

require("footer.php");
?>

<style>

button#check_website {
    background-color: #bb92ea !important;
}
button#copy {
    background-color: black;
}
button#copy_report {
    /* padding: 0 20px; */
    padding-left: 42px !important;
    padding-right: 42px !important;
}
.sidenav .navbar-brand {
    
    display: flex;
    justify-content: center;
}


.w-60 {
    width: 100% !important;
}
</style>