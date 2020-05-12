<?php
session_start();

include 'header.php';
include 'style.php';

//connect to db

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
//check for session array population

 if (!isset($_SESSION['username']) || !isset($_SESSION['password']) ) {
    echo "nope";
    
}

//get username for heading text
$id= $_SESSION['user_id'];

$query = "SELECT * FROM `user` WHERE user_id = '$id'";

$result = $conn->query($query);
if (!$result) die("Fatal Error");

while ($row = $result->fetch_assoc()) {
    echo "<h1>". $row["username"]. "'s kitchen </h1>"; 
}

echo "<h2> Here are the ingredients you have.</h2>";

//query and display list of ingredients 

$query="SELECT ingredient_id, name, amt_available FROM ingredient WHERE user_id = $id && amt_available > 0";
$result = $conn->query($query);
if (!$result) die("Fatal Error");
while ($row = $result->fetch_assoc()) {
    echo $row["name"].", ".$row["amt_available"]." grams<p></p>";

}


if (isset($_POST['submit'])) {
    if ((empty($_POST['name'])) || (empty($_POST['amt_available']))) {
        echo "<p>You didn't fill out all the fields!</p>";
    } else {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        //clean up form inputs for sql use
        $name = sanitizeMySQL($conn, $_POST['name']);
        $amt_available = sanitizeMySQL($conn, $_POST['amt_available']);   
        //add ingredient into database      
        $query = "INSERT INTO ingredient VALUES (NULL, \"$name\", $amt_available, $id)";
        $result = $conn->query($query);
        if (!$result) {
            die ("Database access failed: " . $conn->error);
        } else {
            echo "<p>You just added a new ingredient! Refresh the page to see your updated list</p>";
        }
    }
}

//sanitize functions
function sanitizeString($var)
{
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}
function sanitizeMySQL($connection, $var)
{
    $var = sanitizeString($var);
    $var = $connection->real_escape_string($var);
    return $var;
}
?>
<!doctype HTML>
<html>
<head>
    <title> IHFAH: Your Ingredients</title>
</head>
<body>
<form method="post" action="">
    <fieldset>
        <legend>Add an Ingredient</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" required><br> 
        <label for="amt_available">Amount:</label> 
        <input type="text" name="amt_available" required><br>
        <input type="submit" name="submit">
    </fieldset>
</form>
</body>
<a href="profile.php">Back to your profile</p>
</html>

