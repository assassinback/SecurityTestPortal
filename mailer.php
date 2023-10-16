<!DOCTYPE html>

<html lang="en">
    <head>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="style.css">
        <?php
        $page_name="PHP Mailer";
        require("menu.php");
        require("header.php");
        ?>
        <title><?php echo $page_name; ?></title>
        <style>
        /* a {text-align: center;}
        h1 {text-align: center;}
        p {text-align: center; color:white;}
        div {text-align: center;}
        input {text-align: center;}
        h3 {text-align: center;} */
        </style>
        <script>
        $( document ).ready(function() {
            $("#idForm").submit(function(e) {

            e.preventDefault(); 

            var form = $(this);
            var actionUrl = form.attr('action');
            
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    //   $('#itemlistform').trigger('reset';
                //   alert(data); // show response from the php script.
                    // console.log(data);
                    
                    document.getElementById("result_text").innerHTML=data;
                    $('input[name="mail_from"]').val('');
                     var resultText = $("#result_text");
                    resultText.fadeIn();
                    setTimeout(function() {
                        resultText.fadeOut();
                    }, 3000); 
                }
                
               
            });
            
    });
        });
        
        
        
    </script>
    </head>
    
    
    <body>
        <b>
            <br><br>
            <div class="logo">
            <center><img src="assets/img/logos/cropped-Group-18-e1690326077285.png" alt="NJ kHAN" ></center>
        </div>

            <!-- <h1 style="color: rgb(255, 0, 0); font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ;">PHP Mailer</h1>     -->
            <h3 style="color: darkgreen; font-family:monospace; text-align: center;">
This is a simple PHP E-Mailer, please run this on a webserver, apache is 
not the recommended for this.</h3>
            <br>
        </b>
	
        <!-- <p style="text-align: center;"> --> 
        <form id="idForm" style="text-align: center;" action="mail.php" method="POST" name="send_mail">
            <!-- <input class="input email" type="text" name="email" placeholder=" E-Mail"/> -->
            <br>
            <select class="input1" name="mail_to">
                <option value="temp.securebyte@gmail.com">temp.securebyte@gmail.com</option>
                <option value="njkhan514@gmail.com">njkhan514@gmail.com</option>
                <option value="ziakhan1198@gmail.com">ziakhan1198@gmail.com</option>
                <option value="official.njkhan@gmail.com">official.njkhan@gmail.com</option>
               
              </select>
           
            <br>

            <!-- <br>
            <input class="input1" type="text" name="mail_to" value="temp.securebyte@gmail.com">
            <br> -->
	    <br>
            <input class="input1" type="text" name="mail_from" placeholder="Mail From (Spoofed)">
            <br>
	    <br>
            <input class="input1" type="text" name="subject" value="Vulnerability Detected, Remediation Required!">
            <br>
	    <br>
            <textarea class="input2" type="text" name="message" value="This is a testing email">
Hello,

Your latest subscription payment was unsuccessful.

You bill for $$$ is now overdue. Please make this payment as soon as possible using the link below.

View your bill online: INV-0002

If you have any questions, please don’t hesitate to get in touch.

Thanks.


	    </textarea>
            <br>
	    <br>
            <input class="input3" type="text" name="count" value="1">
            <input class="input4" type="submit" name="submit" placeholder="Send Mail"> 
        </form>
        <h3 id="result_text"></h3>
        <br><br><br>
        <b>
            <p style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; text-align: center;">
            
            </p>
        </b>
        
    </body>

</html>


