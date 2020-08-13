<?php require_once 'inc/connection.php';?>
<?php
    function sendPasswordResetLink($userEmail,$tokenPass,$name)
    {
        $subject="Reset your password-CeylonTrek";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $from="Ceylon-Trek";
    // Create email headers
        $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
     
        $message='
        <html >
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset your password</title>
        </head>
        <body>
                <form style="position: absolute;
                            top: 50%;
                            margin-left:150px; 
                            transform: translate(-50%,-50%);
                            width: 450px;
                            padding: 40px;
                            background:rgb(209, 206, 206);
                            box-sizing: border-box;
                            box-shadow: 0 5px 25px rgba(0,0,0,.5);
                            border-radius: 10px;">
                    <h1 style="font-size:22px;color:#087186;padding-left:70px;"><b>Reset Your Password</b></h1>
                    <h4 style="font-size:18px;">Hi <b>'.$name.'!</b></h4>
                    <p style="font-size:16px;">
                        You recently requested to reset your password for your ceylon trek account.Click the button below to reset it.
                    </p>
                    <a style="background-color: blue; color: white;padding :10px ;margin-left:110px;border:none ; border-radius:5px; font-size:16px;text-decoration:none;" href="http://localhost/ceylon trek/index.php?tokenPassword='.$tokenPass.'">Reset password</a>
                    <p style="font-size:16px;">
                        If you did not request a password reset,You can safely ignore this email or reply to let us know.<br><br>
                        Thanks,<br> ---Ceylon-Trek---

                    </p>

                </form>
        
        </body>
        </html>';

        mail($userEmail,$subject,$message,$headers);
    }

?>
