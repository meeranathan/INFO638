<?php
session_start(); 
include 'header.php';
include 'style.php';

if (isset($_POST['submit'])) { //make sure both fields have been submitted
    if ( empty($_POST['username']) || empty($_POST['password']) ) {
        echo "<p>You didn't enter your username or password</p>";
    } else {
        //connect to database
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        //clean up input from forms for use in mysql
        $username = sanitizeMySQL($conn, $_POST['username']);
        $password = sanitizeMySQL($conn, $_POST['password']); 
        //check that username and password match       
        $query  = "SELECT * FROM user WHERE username='$username' AND password='$password'"; 
        $result = $conn->query($query);    
        if (!$result) die($conn->error); 
        $rows = $result->num_rows;
        if ($rows==1) {
            $row = $result->fetch_assoc();
            //populate session array
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['user_id'] = $row['user_id'];  
            //successful login redirects to profile page
            header("Location: profile.php");           
        } else {
            //unsuccessful login yeilds error message
            echo "<p>Invalid username/password combination!</p>";
        }
    }
}

//sanitize functions 
function sanitizeString($var){
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}
function sanitizeMySQL($connection, $var){
    $var = sanitizeString($var);
    $var = $connection->real_escape_string($var);
    return $var;
}
?>
<!doctype HTML>
<HTML>
    <head>
        <title> Welcome to IHFAH </title>
    </head>
    <body>
        <fieldset><legend>Welcome to <em> I Have Food at Home</em></legend>
        <form method="POST" action="">
        Username:<br><input type="text" name="username" size="40"><br>
        Password:<br><input type="password" name="password" size="40"><br>
        <input type="submit" name="submit" value="Log-In">
        </form>
        </fieldset>

        <p><strong> I Have Food At Home </strong>is a tool for keeping track of what ingredients are in your kitchen, what recipes you know how to make, and what meals you've made at home. </p>
    </body>

</HTML>
