<?php

function randomString($length = 10, $type='both') {
    
    $number = '0123456789';
    $character = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    if($type == 'character') {
        $source = $character;
    } else if($type == 'number') {
        $source = $number;
    } else {
        $source = $number . $character;
    }
    
    $string = substr(str_shuffle(str_repeat($source, ceil($length/strlen($source)) )),1,$length);
    
    return $string;
}

function insertData($table="", $data=array()) {
    global $db, $dbPrefix, $list;
    
    if ($table == "" || count($data) == 0) {
        return false;
    }
    
    $columns = array();
    $values = array_values($data);
    foreach ($data as $key=>$value) {
        $columns[] = $key . ' = ?';
    }
    $columns = implode(', ', $columns);
    
    $sql = 'INSERT INTO ' . $dbPrefix . $table . ' SET ' . $columns;
    // echo json_encode($sql);
    $db->query($sql, $values);
    //echo $db->last_query();
    
    $insert_id = $db->insert_id();
    return $insert_id;
}
function maxId($table="",$where="",$data=array())
{
    global $db, $dbPrefix, $list;
    
    if ($table == "") {
        return false;
    }
    if($data!=null)
    {
        $columns = array();
        $values = array_values($data);
        foreach ($data as $key=>$value) {
            $columns[] = $key . ' = ?';
        }
        $columns = implode(', ', $columns);
    }
    $sql = "SELECT max(id) FROM user_info UNION SELECT max(id) from in_process UNION SELECT max(id) FROM completed;";
    
    if ($where != "") {
        $sql .= ' WHERE ' . $where; 
    }
    if($data==null)
    {
        $update = $db->query($sql);
    }
    else
    {
        $update = $db->query($sql, $values);
    }
    
    //echo $db->last_query();
    $row=$update->result_array();
    $max=0;
    foreach($row as $rows)
    {
        if($max<$rows["max(id)"])
        {
            $max=$rows["max(id)"];
        }
    }
    return $max;
}
function insertDataExtra($table="",$name="")
{
    global $db, $dbPrefix, $list;
    
    $sql = 'INSERT INTO ' . $dbPrefix . $table . " VALUES (NULL, '$name', 1)";
    $db->query($sql);
    //echo $db->last_query();
    
    $insert_id = $db->insert_id();
    return $insert_id;
}

function deleteData($table="", $data=array(), $where="") {
    global $db, $dbPrefix, $list;
    
    if ($table == "" || count($data) == 0) {
        return false;
    }
    
    $columns = array();
    $values = array_values($data);
    foreach ($data as $key=>$value) {
        $columns[] = $key . ' = ?';
    }
    $columns = implode(', ', $columns);
    
    $sql = 'DELETE FROM ' . $dbPrefix . $table;
    
    if ($where != "") {
        $sql .= ' WHERE ' . $where; 
    }
    $update = $db->query($sql, $values);
    //echo $db->last_query();
    
    return $update;
}

function updateData($table="", $data=array(), $where="") {
    global $db, $dbPrefix, $list;
    
    if ($table == "" || count($data) == 0) {
        return false;
    }
    
    $columns = array();
    $values = array_values($data);
    foreach ($data as $key=>$value) {
        $columns[] = $key . ' = ?';
    }
    $columns = implode(', ', $columns);
    
    $sql = 'UPDATE ' . $dbPrefix . $table . ' SET ' . $columns;
    
    if ($where != "") {
        $sql .= ' WHERE ' . $where; 
    }
    $update = $db->query($sql, $values);
    //echo $db->last_query();
    
    return $update;
}

function disableData($table="", $data=array(), $where="") {
    global $db, $dbPrefix, $list;
    
    if ($table == "" || count($data) == 0) {
        return false;
    }
    
    $columns = array();
    $values = array_values($data);
    foreach ($data as $key=>$value) {
        $columns[] = $key . ' = ?';
    }
    $columns = implode(', ', $columns);
    
    $sql = 'UPDATE ' . $dbPrefix . $table . ' SET ' . $columns;
    
    if ($where != "") {
        $sql .= ' WHERE ' . $where; 
    }
    $update = $db->query($sql, $values);
    //echo $db->last_query();
    
    return $update;
}


/********** Admin **********/

function checkAdminLogin() {
    if (isset($_SESSION['adminsessionid'])) {
        return true;
    } else {
        return false;
    }
}

function checkLoginAsk() {
    global $db, $dbPrefix;
    if (isset($_SESSION['id'])) {
        $result = $db->query('SELECT * FROM ' . $dbPrefix . 'admin_info WHERE username = ? AND password = ?', array($_POST['username'],$_POST['password']));
        if ($result->num_rows() > 0) {
            return true;
        } else {
            unset($_SESSION['id']);
            unset($_SESSION['user_type']);
            return false;
        }
    } else {
        return false;
    }
}

function get_user_row_count($table="")
{
    global $db,$dbPrefix,$list;
    $query="SELECT COUNT(*) as rowcount FROM ".$table;
    $result=$db->query($query);
    $row=$result->result_array();
    $count=0;
    foreach($row as $rows)
    {
        $count=$rows["rowcount"];
    }
    return $count;
}
function get_max_id($table="")
{
    global $db,$dbPrefix,$list;
    $query="SELECT MAX(Id) as maxid FROM ".$table;
    $result=$db->query($query);
    $row=$result->result_array();
    $count=0;
    foreach($row as $rows)
    {
        $count=$rows["maxid"];
    }
    return $count;
}
function selectCount($table="",$where="", $data=array()) {
    global $db, $dbPrefix, $list;
    
    if ($table == "") {
        return false;
    }
    if($data!=null)
    {
        $columns = array();
        $values = array_values($data);
        foreach ($data as $key=>$value) {
            $columns[] = $key . ' = ?';
        }
        $columns = implode(', ', $columns);
    }
    $sql = 'SELECT COUNT(*) as amount FROM ' . $dbPrefix . $table;
    
    if ($where != "") {
        $sql .= ' WHERE ' . $where; 
    }
    if($data==null)
    {
        $update = $db->query($sql);
    }
    else
    {
        $update = $db->query($sql, $values);
    }
    // echo $sql;
    //echo $db->last_query();
    $row=$update->result_array();
    foreach($row as $rows)
    {
        return $rows["amount"];
    }
    return 0;
}
function selectData($table="",$where="", $data=array()) {
    global $db, $dbPrefix, $list;
    
    if ($table == "") {
        return false;
    }
    if($data!=null)
    {
        $columns = array();
        $values = array_values($data);
        foreach ($data as $key=>$value) {
            $columns[] = $key . ' = ?';
        }
        $columns = implode(', ', $columns);
    }
    $sql = 'SELECT * FROM ' . $dbPrefix . $table;
    
    if ($where != "") {
        $sql .= ' WHERE ' . $where; 
    }
    if($data==null)
    {
        $update = $db->query($sql);
    }
    else
    {
        $update = $db->query($sql, $values);
    }
    
    //echo $db->last_query();
    $row=$update->result_array();
    return $row;
}
function last_insert_id($table="")
{
    global $db, $dbPrefix, $list;
    
    $sql = "SELECT MAX(ID) as max FROM $table";
    $query=$db->query($sql);
    $row=$query->result_array();
    foreach($row as $rows)
    {
        return $rows["max"]; 
    }
    return 0;
}
function selectNumRows($table="",$where="", $data=array()) {
    global $db, $dbPrefix, $list;
    
    if ($table == "") {
        return false;
    }
    if($data!=null)
    {
        $columns = array();
        $values = array_values($data);
        foreach ($data as $key=>$value) {
            $columns[] = $key . ' = ?';
        }
        $columns = implode(', ', $columns);
    }
    $sql = 'SELECT * FROM ' . $dbPrefix . $table;
    
    if ($where != "") {
        $sql .= ' WHERE ' . $where; 
    }
    if($data==null)
    {
        $update = $db->query($sql);
    }
    else
    {
        $update = $db->query($sql, $values);
    }
    return $update->num_rows();
}
function checkPrivilage($check="",$required="")
{
    if(isset($_SESSION["username"]))
    {
        if($check==$required)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        header("Location:login.php");
    }
    return false;
}
function checkLoggedin()
{
    if(isset($_SESSION["username"]))
    {
        return true;
    }
    else
    {
        header("Location:login.php");
        return false;
    }
    return false;
}


function create_table()
{
    echo "<table class='table align-items-center' id='export'>";
    echo "<thead><tr>";
    echo "<th>S.No</th>";
    echo "<th>Date</th>";
    echo "<th>Website</th>";
    echo "<th>Bug</th>";
    echo "<th>Email</th>";
    echo "</tr></thead>";
}
function create_data()
{
    $username=$_SESSION["username"];
    $_SESSION["count"]=1;
    $sites=selectData("website_info","insert_admin='$username' AND status='completed' ORDER BY id LIMIT 200");
    echo "<tbody id='table_of_items'>";
    foreach($sites as $site)
    {
        echo "<tr>";
        // echo "<td>".$site['id']."</td>";
        echo "<td>".$_SESSION["count"]."</td>";
        echo "<td>".$site['date']."</td>";
        echo "<td>".$site['website']."</td>";
        echo "<td>".$site['bug']."</td>";
        echo "<td>".$site['email']."</td>";
        echo "</tr>";
        $_SESSION["count"]=$_SESSION["count"]+1;    
    }
    echo "</tbody></table>";
}
function create_table_no_limit()
{
    echo "<table class='table align-items-center' id='export'>";
    echo "<thead><tr>";
    echo "<th>S.No</th>";
    echo "<th>Date</th>";
    echo "<th>Website</th>";
    echo "<th>Bug</th>";
    echo "<th>Email</th>";
    echo "<th>Insert Admin</th>";
    echo "</tr></thead>";
}
function create_data_no_limit()
{
    $sites=selectData("website_info","id ORDER BY id DESC LIMIT 500");
    echo "<tbody>";
    foreach($sites as $site)
    {
        echo "<tr>";
        echo "<td>".$site['id']."</td>";
        echo "<td>".$site['date']."</td>";
        echo "<td>".$site['website']."</td>";
        echo "<td>".$site['bug']."</td>";
        echo "<td>".$site['email']."</td>";
        echo "<td>".$site['insert_admin']."</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}
function create_search_data($query_string)
{
    // echo "id LIKE '%$query_string%' OR date LIKE '%$query_string%' OR website LIKE '%$query_string%' OR bug LIKE '%$query_string%' OR email LIKE '%$query_string%' OR insert_admin LIKE '%$query_string%' id ORDER BY id LIMIT 500";
    $sites=selectData("website_info","id LIKE '%$query_string%' OR date LIKE '%$query_string%' OR website LIKE '%$query_string%' OR bug LIKE '%$query_string%' OR email LIKE '%$query_string%' OR insert_admin LIKE '%$query_string%' ORDER BY id LIMIT 500");
    
    echo "<tbody>";
    foreach($sites as $site)
    {
        echo "<tr>";
        echo "<td>".$site['id']."</td>";
        echo "<td>".$site['date']."</td>";
        echo "<td>".$site['website']."</td>";
        echo "<td>".$site['bug']."</td>";
        echo "<td>".$site['email']."</td>";
        echo "<td>".$site['insert_admin']."</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

function create_fields_new()
{
    $bugs=selectData("bug_info");
    ?>
    <form id="search_form" method="POST" style="margin-top:50px !important;">
        <div class="card z-index-2 h-70">
            <div class="card-body p-3">

              
              <div class="row align-items-center">
                <div class="col-lg-8">
                  <div class="row">

                    <div class="col-lg-10 mb-0 pb-0">
                      <input type="text" class="form-control" id="inputAddress" name="website_link" placeholder="Enter Website Link">
                    </div>
                    <div class="col-lg-2 mb-0 p-0">
                      <button type="submit" class="btn btn-primary5_5" id="check_website" name="check_website" value="Check Website"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
                      
                    </div>
                  </div>
                  
                  <form class="row g-4">
                    
                      
                      
                    <div class="col-12 mb-3">
                      
                      <input type="text" name="extra_data" class="form-control" id="inputAddress" placeholder="Enter Login Link OR Email">
                    </div>
        
                    <div class="row mb-0">
                    <div class="col-lg-10 mb-0 pb-0">
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">                    </div>
                    <div class="col-lg-1 mb-0 p-0">
                      <button type="submit" class="btn btn-primary5_5" id="copy_email" name="copy_email" value="Check Website"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z"/></svg></button>
                    </div></div>

                    <!-- <div class="col-12">
                    
                      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
                      
                    </div> -->
                    

                    <div class="row">
                    <div class="col-lg-10 mb-0 pb-0">
                    <input type="sub" class="form-control" id="sub4" placeholder="Subject" name="Subject" value="Vulnerability Detected, Remediation Required">
                    </div>
                    <div class="col-lg-1 mb-0 p-0">
                      <button type="submit" class="btn btn-primary5_5" id="copy" name="copy_link" value="Check Website"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z"/></svg></button>
                    </div></div>
                    <!-- <div class="col-12">
                    ..................
                      <input type="sub" class="form-control" id="sub4" placeholder="Subject" name="Subject" value="Vulnerability Detected, Remediation Required">
                    </div> -->

                    <!-- <div class="col-12">
                      
                        <input class="form-control form-control-sm" type="text" name="extra_data" placeholder="Extra Data(Iframe src)" value="">
                    </div> -->
                    <div class="col-12" >
                      
                    <button type="submit" class="btn btn-primary1" id="generate_report" name="generate_report" value="Generate Report">Generate Report</button>
                    <button type="submit" class="btn btn-primary1 px-4" id="copy_report" name="copy_report" value="Copy Report" ><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z"/></svg></button>
                    <button type="submit" class="btn btn-primary1" id="submit_report" name="submit_report" value="Submit Report">Send Report</button>

                    </div>
                    
                    <!-- <div class="col-md-1">
                      
                      <select id="inputState" class="form-select">
                        <option selected>Bug...</option>
                        <option>...</option>
                      </select>
                      
                    </div> -->
                    <!-- <div class="col-12">
                      <button type="submit" class="btn btn-primary1" id="submit_report" name="submit_report" value="Submit Report">Send Report</button>
                    </div> -->
                    <!-- <div class="col-12">
                      <button type="submit" class="btn btn-primary1" id="copy_report" name="copy_report" value="Copy Report">Copy Report</button>
                    </div> -->
                   
                  </form>
                 
  
                </div>
                

                <!-- radio buttion start -->
                <div class="col-lg-4">
                
                        <?php
                            foreach($bugs as $rows)
                            {
                                ?>
                                    <div class="btn-group btn-group-toggle col-10" data-toggle="buttons">

<label class="btn btn-primary8">
                                    <input type="radio" name="type" value="<?php echo $rows["bug_name"]; ?>" id="option2" autocomplete="off"> <?php echo $rows["bug_name"]; ?>
                                    </label></div>
                                <?php
                            }
                        ?>
                
                     

              

                <!-- radio buttion end -->
              

              
                  
                </div>
              </div>
    
             
              <div class="col-md-12 text-center">
                      
                <p id="check_tested"> </p>
              </div>
            
          </div>
          
          
         </div>
</form>
    <?php

}
?>