<?php
if(isset($_POST)) {
    require("config.php");
    // echo json_encode($_POST);
    $site=$_POST["website_link"];
    $site = parse_url($site, PHP_URL_HOST);
    // echo json_encode($site);
    $count=selectCount("website_info"," website LIKE '$site'");
    if($count<=0)
    {
        echo json_encode("Website Not Tested");
    }
    if($count>0)
    {
        echo json_encode("Website Tested");
    }
}

?>