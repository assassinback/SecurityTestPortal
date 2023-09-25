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

function create_fields()
{
    $bugs=selectData("bug_info");
    
    ?>
    <form id="search_form" method="POST" style="margin-top:50px !important;">
        <input class="form-control form-control-sm" type="text" name="website_link" placeholder="Enter Website Domain">
        <input class="form-control form-control-sm" type="text" name="email" placeholder="Enter Email">
        <input class="form-control form-control-sm" type="text" name="Subject" placeholder="Subject" value="Vulnerability Detected, Remediation Required">
        <select name="type" class="form-control form-control-sm">
            
            <option value="none" selected="selected">Select Bug</option>

            <?php
                foreach($bugs as $rows)
                {
                    ?>
                        <option value="<?php echo $rows["bug_name"];  ?>"><?php echo $rows["bug_name"];  ?></option>
                    <?php
                }
            ?>
        </select><br><br>
        <input class="btn btn-sm btn-primary btn-lg w-40 mt-4 mb-0" type="submit" id="check_website" name="check_website" value="Check Website">
        <input class="btn btn-sm btn-primary btn-lg w-40 mt-4 mb-0" type="submit" id="generate_report" name="generate_report" value="Generate Report">
        <input class="btn btn-sm btn-primary btn-lg w-40 mt-4 mb-0" type="submit" id="copy_report" name="copy_report" value="Copy Report">
        <input class="btn btn-sm btn-primary btn-lg w-40 mt-4 mb-0" type="submit" id="submit_report" name="submit_report" value="Submit Report"><br><br>
        <label class='text-center text-uppercase text-xs font-weight-bolder opacity-10' id="search_result"></label>

        <textarea id="report_info" name="report_info" rows="20" cols="125"></textarea>
        <?php
            create_table();
            create_data();
            
        ?>
    </form>
    <?php
}
function create_table()
{
    echo "<div class='card-body px-0 pt-0 pb-2'>
    <div id='table-responsive' class='table-responsive p-0'><table class='table align-items-center mb-0'>";
        echo "<thead><tr>";
    echo "<th class='text-center text-uppercase text-xs font-weight-bolder opacity-10'>S.No</th>";
    echo "<th class='text-center text-uppercase text-xs font-weight-bolder opacity-10'>Date</th>";
    echo "<th class='text-center text-uppercase text-xs font-weight-bolder opacity-10'>Website</th>";
    echo "<th class='text-center text-uppercase text-xs font-weight-bolder opacity-10'>Bug</th>";
    echo "<th class='text-center text-uppercase text-xs font-weight-bolder opacity-10'>Email</th>";
    echo "</tr></thead>";
}
function create_data()
{
    $sites=selectData("website_info","id ORDER BY id DESC LIMIT 50");
    echo "<tbody id='tbody-zia'>";
    foreach($sites as $site)
    {
        echo "</tr>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['id']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['date']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['website']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['bug']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['email']."</td>";
        echo "</tr>";
    }
    echo "</tbody></table></div></div></div></div></div></div>";
}
function create_data_no_limit()
{
    $sites=selectData("website_info");
    echo "<tbody id='tbody-zia'>";
    foreach($sites as $site)
    {
        echo "</tr>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['id']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['date']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['website']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['bug']."</td>";
        echo "<td class='text-center text-secondary text-xs font-weight-bold'>".$site['email']."</td>";
        echo "</tr>";
    }
    echo "</tbody></table></div></div></div></div></div></div>";
}
?>