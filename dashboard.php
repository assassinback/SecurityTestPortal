<?php
$page_name="Dashboard";
require("menu.php");
require("header.php");
?>

<?php
create_fields();

?>


<script>
    var reports="";
    // $('form').on('submit', function (e) {
    // e.preventDefault();

    // var url = $(this).attr("action");
    // var form_data = $(this).serialize();
    // $.ajax({
    // type: 'POST',
    // url: url,
    // data: $('#search_form').serialize() ,
    // dataType : 'json', 
    // success: function (data) { 
    //     console.log(data); 
    //     // document.getElementById("search_result").innerHTML=data;
    // }
    // })});
    function removeHttp(url) {
        return url.replace(/^https?:\/\//, '');
    }
    $('#check_website').click(function (e) {
        
        e.preventDefault();
        
        // var url = $(this).attr("action");
        var url="search_data.php";
        $.ajax({
        type: 'POST',
        url: url,
        data: $('#search_form').serialize(),
        dataType : 'json', 
        success: function (data) {
            $("#search_result").html(data);
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        })
    
    });
    $('#generate_report').click(function (e) {
        
        e.preventDefault();
        
        // var url = $(this).attr("action");
        var url="create_report.php";
        $.ajax({
        type: 'POST',
        url: url,
        data: $('#search_form').serialize(),
        dataType : 'json', 
        success: function (data) {
            $("#report_info").html(data);
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        });
    
    });
    $('#copy_report').click(function (e) {
        
        e.preventDefault();
        
        var copyText = document.getElementById("report_info");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value);
    
    });
    $('#submit_report').click(function (e) {
        
        e.preventDefault();
        
        // var url = $(this).attr("action");
        var url="submit_report.php";
        $.ajax({
        type: 'POST',
        url: url,
        data: $('#search_form').serialize(),
        dataType : 'json', 
        success: function (data) {
            $("#search_result").html(data);
            $("#search_form")[0].reset();
            // document.getElementById('tbody-zia').remove();
        },
        error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
        });
    
    });
</script>






<?php

require("footer.php");
?>