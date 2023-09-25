<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="logo.png">
    <link rel="icon" type="image/png" href="logo.png">
    <title>
        <?php
          echo $page_name;

        ?>
    </title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <?php
    require("config.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    table, th, td {
        border: 1px solid black !important;
    }
    .clickedrow
    {
        background-color: #EEEEEE;
    }

    .btn:not([class*="btn-outline-"]) 
    {
        border: 0;
        margin-left: 20px;
    }
    input.form-control.form-control-sm 
    {
        display: inline !important;
        width: 250px !important;
    }
    select.form-control.form-control-sm 
    {
        display: inline !important;
        width: 250px !important;
    }
    input.btn.btn-sm.btn-primary.btn-lg.w-40.mt-4.mb-0 
    {
        width: 200px !important;
        display: inline !important;
    }
    #space
    {
      margin-top:150px !important;
    }


    </style>
    <script>
      $(document).ready(function() {
      $('.table td').on('click', function() 
      {
        $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
        // add highlight to the parent tr of the clicked td
        $(this).closest('tr').addClass("clickedrow");
      });
    });
    </script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <?php
    // if(!checkLoggedin())
    // {
    //   header("Location:login.php");
    // }
  ?>
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" " target="_blank">
        <img src="logo.png" class="" alt="main_logo">
        <!-- <span class="ms-1 font-weight-bold">Argon Dashboard 2</span> -->
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
<?php
    if(checkLoggedin())
    {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <?php
    }
?><?php
if(checkLoggedin())
{
  ?>
        <li class="nav-item">
          <a class="nav-link " href="submissions.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Submissions</span>
          </a>
        </li>

        <?php
}

?>
<?php
if(checkLoggedin())
{
  ?>

        <li class="nav-item">
          <a class="nav-link " href="clickjacking.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Clickjacking</span>
          </a>
        </li>

        <?php
}
        ?>
        <?php
if(checkLoggedin())
{
  ?>

        <li class="nav-item">
          <a class="nav-link " href="sign_out.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>

        <?php
}
        ?>
        
        
        
        
        
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        
      </div>
    </nav>