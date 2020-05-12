<?php
session_start();
$_SESSION = array();
session_destroy();
include 'header.php';
include 'style.php';
?>
<!doctype HTML>
<HTML>
    <head>
        <title> Thanks for using IHFAH </title>
    </head>
    <body>
        <p>Thanks for using IHFAH!</p>
        <p><a href="login.php">I want to go back!</a></p>

    </body>

</HTML>