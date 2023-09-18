<?php
$page_name="Login";
require("login_menu.php");
require("header.php");
if(isset($_SESSION["username"]))
{
    if($_SESSION["user_type"]=="counsellor" || $_SESSION["user_type"]=="admin")
    {
        header("Location:show_data.php");
    }
    else
    {
        header("Location:show_inprocess.php");
    }
}
if(isset($_POST["username"]))
{
    
    $rows=selectNumRows("admin_info", " username='".$_POST["username"]."' AND password='".$_POST["password"]."'");
    if($rows>0)
    {
        $admin_data=selectData("admin_info", " username='".$_POST["username"]."'");
        foreach($admin_data as $rows)
        {
            $_SESSION["user_type"]=$rows["user_type"];
            $_SESSION["username"]=$rows["username"];
            $_SESSION["full_name"]=$rows["full_name"];
        }
        if($_SESSION["user_type"]=="counsellor" || $_SESSION["user_type"]=="admin")
        {
            header("Location:show_data.php");
        }
        else
        {
            header("Location:show_inprocess.php");
        }
    }
}






?>

<form method="POST" style="margin-top:220px !important;">
    <label>Username:</label><br><input class="form-control form-control-lg" type="text" name="username"><br><br>
    <label>Password:</label><br><input class="form-control form-control-lg" type="password" name="password"><br><br>
    <input class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" type="submit" value="Login" name="login">
</form>



<?php
    require("footer.php")
?>