<?php
if(isset($_POST)) {
    require("config.php");
    // echo json_encode($_POST);
    $site=$_POST["website_link"];
    $site = parse_url($site, PHP_URL_HOST);
    if(!isset($_POST["website_link"]) || $_POST["website_link"]==null || $_POST["website_link"]=="")
    {
        echo json_encode("Please Enter Website Link");    
    }
    else
    {
        $new_data["date"]=date("d/m/Y");
        $new_data["website"]=$site;
        $new_data["email"]=$_POST["email"];
        // $new_data["bug"]=$_SESSION["reports"];
        $new_data["bug"]=$_POST["type"];
        $new_data["status"]="completed";
        $new_data["insert_admin"]=$_SESSION["username"];
        insertData("website_info",$new_data);
        unset($_SESSION['reports']);
        // $lastid=last_insert_id("website_info");
        $new_data["id"]=$_SESSION["count"]+1;
        $_SESSION["count"]=$_SESSION["count"]+1;
        echo json_encode($new_data);
        // echo json_encode("123");    
    }
    
    
}

?>