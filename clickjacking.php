<?php
$page_name="Clickjacking";
require("menu.php");
require("header.php");
?>


<input class="form-control form-control-sm" type="text" id="iframe_src" name="iframe_src" placeholder="Enter Iframe Link"><br><br>
<input class="btn btn-sm btn-primary btn-lg w-40 mt-4 mb-0" type="submit" id="check_website" name="check_website" value="Check Website">
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