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
//get username for headeing text 
$id= $_SESSION['user_id'];

$query = "SELECT * FROM `user` WHERE user_id = '$id'";

$result = $conn->query($query);
if (!$result) die("Fatal Error");

while ($row = $result->fetch_assoc()) {
    echo "<h1>". $row["username"]. "'s Recipe Book </h1>"; 
}

echo "<h2> Here are the recipes you've added.</h2>";

//query to display recipes

$query="SELECT * from recipe where recipe_id = (SELECT recipe_id WHERE user_id='$id')";
$result = $conn->query($query);
if (!$result) die("Fatal Error");
while ($row = $result->fetch_assoc()) {
    echo $row["title"].", ".$row["num_servings"]." servings, ".$row["calories_per_serving"]." cals per serving";
    //add "View" button to view each recipe
    echo "<a href=\"onerecipe.php?recipe_id=".$row["recipe_id"]."\">"."View"."</a>"."<p></p>";
}


if (isset($_POST['submit'])) { //check to make sure all fields are added
    if ((empty($_POST['title'])) || (empty($_POST['num_servings']))) {
        echo "<p>You didn't fill out all the fields!</p>";
    } else {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        //clean form inputs for sql use
        $title = sanitizeMySQL($conn, $_POST['title']);
        $num_servings = sanitizeMySQL($conn, $_POST['num_servings']);
        $calories_per_serving = sanitizeMySQL($conn, $_POST['calories_per_serving']);  
        //insert recipe into db       
        $query = "INSERT INTO recipe  VALUES (NULL, \"$title\", $num_servings, $calories_per_serving, $id)";
        $result = $conn->query($query);
        if (!$result) {
            die ("Database access failed: " . $conn->error);
        } else {
            echo "<p>You just added a new recipe! Refresh the page to see your updated list</p>";
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
    <title> IHFAH: Your Recipes</title>
</head>
<body>
<form method="post" action="">
    <fieldset>
        <legend>Add a new Recipe</legend>
        <label for="title">Title:</label>
        <input type="text" name="title" required><br> 
        <label for="num_servings">Number of Servings:</label> 
        <input type="text" name="num_servings" required><br>
        <label for="calories_per_serving">Calories per Serving:</label>
        <input type="text" name="calories_per_serving"><br> 
        <input type="submit" name="submit">
    </fieldset>
</form>

<a href="profile.php">Back to your profile</p>

</body>
</html>
