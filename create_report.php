<?php
if(isset($_POST)) {
    require("config.php");
    // echo json_encode($_POST);
    $site=$_POST["website_link"];
    $email=$_POST["email"];
    $Subject=$_POST["Subject"];
    $type=$_POST["type"];
    $site = parse_url($site, PHP_URL_HOST);
    $row=selectData("bug_info"," bug_name='$type'");
    if($type=="none")
    {
        echo json_encode("Please Select A Bug");
    }
    else if($email=="")
    {
        echo json_encode("Please Write Email");
    }
    else
    {
        foreach($row as $rows)
        {
            if(isset($_SESSION["reports"]))
            {
                $_SESSION["reports"].=", ".$type;
            }
            else
            {
                $_SESSION["reports"]=$type;
            }
            $rows["bug_report"]=str_replace("[website_name]",$site,$rows["bug_report"]);
            echo json_encode($rows["bug_report"]);
        }
    }
}

?>