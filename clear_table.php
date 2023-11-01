<?php
if(isset($_POST)) {
    require("config.php");
    // echo json_encode($_POST);
    $site=$_POST["website_link"];
    $site = parse_url($site, PHP_URL_HOST);

    $new_data["status"]="cleared";
    $username=$_SESSION["username"];
    updateData("website_info",$new_data, "insert_admin='$username'");
    echo json_encode("Data Cleared, Please refresh");
    
}

?>