<?php
if(isset($_POST)) {
    require("config.php");
    // echo json_encode($_POST);
    $site=$_POST["website_link"];
    $site = parse_url($site, PHP_URL_HOST);

    $new_data["date"]=date("d/m/Y");
    $new_data["website"]=$site;
    $new_data["email"]=$_POST["email"];
    $new_data["bug"]=$_SESSION["reports"];
    $new_data["status"]="completed";
    insertData("website_info",$new_data);
    unset($_SESSION['reports']);
    echo json_encode("Data Inserted");
    // echo json_encode("123");
    
}

?>