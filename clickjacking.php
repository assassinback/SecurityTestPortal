<?php
$page_name="Clickjacking";
require("menu.php");
require("header.php");
?>

           



       
    
    
   
    <div class="container-fluid py-4">

     

              
              <div class="row justify-content-center pt-2 mt-2 mb-0 pb-0">
                <div class="col-4">
                  <input type="text" class="form-control" id="inputAddress" placeholder="Enter Website Link">
                </div>
                <div class="col-2 mb-0 p-0">
                  <button type="submit" id="check_website" class="btn btn-primary5_5"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>

                </div>
              </div>                        
   
     
      
        <div class="row mt-4">
          <div class="col-lg-12 mb-lg-0 mb-0 ">
            <div class="card z-index-2 h-70">
              <div class="card-body py-3">

             
                
                <div >
                  <iframe id="iframe" src="https://app.zaplify.com/login"  height="650px" width="100%" name="my-iframe" allow="fullscreen"></iframe>
                </div>                        
            </div>        
           </div>        
          </div>
        
      

          
      
    </div>
  </main>








<script>
    $('#check_website').click(function (e) {
        
        e.preventDefault();
        
        document.getElementById("iframe").src=document.getElementById("inputAddress").value;
    
    });

</script>
<style>
.py-4 {
    padding-top: 0px !important;
    padding-bottom: 0px !important;
}
.card.z-index-2.h-70 {
    margin-top: -25px;
}
/* .container-fluid.py-4 {
    margin-top: -5px;
} */
nav#navbarBlur {
    display: none;
}

</style>