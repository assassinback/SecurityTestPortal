<?php
$page_name="Clickjacking";
require("menu.php");
require("header.php");
?>


<input class="form-control form-control-sm" type="text" id="iframe_src" name="iframe_src" placeholder="Enter Iframe Link"><br><br>
<div class="col-12">
    <button class="btn btn-primary1" type="submit" id="check_website" name="check_website" value="Check Website">Check Website</button>
</div>

<br><br>

<iframe id="iframe" src="" width="1000" height="500"></iframe>


<script>
    $('#check_website').click(function (e) {
        
        e.preventDefault();
        
        document.getElementById("iframe").src=document.getElementById("iframe_src").value;
    
    });

</script>






<?php

require("footer.php");
?>