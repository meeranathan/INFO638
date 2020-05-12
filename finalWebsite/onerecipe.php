<?php
session_start();

include 'header.php';
include 'style.php';

//connect to database

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//check if session array is populated 

if (!isset($_SESSION['username']) || !isset($_SESSION['password']) ) {
    echo "nope";
    
}


if (isset($_GET['recipe_id'])) { //check to make sure the recipe exists
    //clean input and get recipe ID for correct page population
    $id = sanitizeMySQL($conn, $_GET['recipe_id']);
    //query db to get recipe information 
    $query = "SELECT * FROM recipe WHERE recipe_id=".$id;
    $result = $conn->query($query);
    if (!$result) die ("Invalid recipe id.");
    $rows = $result->num_rows;
    if ($rows == 0) {
        echo "No recipe found with id of $id<br>";
    } else {
        while ($row = $result->fetch_assoc()) {
            //print heading text with recipe name
            echo '<h1>What you need for '.$row["title"]."</h1>";     
        }
    }
} else {
    echo "This recipe doesn't exist";
}

//query from usage and ingredient tables to get the correct ingredients used in the recipe and their amounts
$query= "SELECT name, ingredient_amt FROM ingredient NATURAL JOIN `usage` WHERE ingredient_id IN (SELECT ingredient_id FROM `usage` WHERE recipe_id =$id)";

$result = $conn->query($query);
if (!$result) die("Fatal Error");

while ($row = $result->fetch_assoc()) {
    echo $row["name"].", ".$row['ingredient_amt']." grams <p></p>";
}

//get user ID to later add ingredients to recipe 
$user=$_SESSION['user_id'];

if (isset($_POST['submit'])) { //check to see if all fields have been added
    if ((empty($_POST['name'])) || (empty($_POST['ingredient_amt']))) {
        echo "<p>You didn't fill out all the fields!</p>";
    } else {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        //clean input data for sql use
        $name = sanitizeMySQL($conn, $_POST['name']);
        $ingredient_amt = sanitizeMySQL($conn, $_POST['ingredient_amt']); 
        //insert ingredient into ingredients table        
        $query = "INSERT INTO ingredient VALUES (NULL, \"$name\", 0, $user)";
        $result = $conn->query($query);
        //get ingredient ID of newest addition, as this is needed to add it to usage table
        $query = "SELECT ingredient_id FROM ingredient WHERE ingredient_id=(SELECT MAX(ingredient_id) FROM ingredient)";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            //insert ingredient into usage table
            $query = "INSERT INTO `usage` VALUES (NULL, $id, $row[ingredient_id], $ingredient_amt)";
        }
        $result = $conn->query($query);
        if (!$result) {
            die ("Database access failed: " . $conn->error);
        } else {
            echo "<p>You just added a new ingredient! Refresh the page to see your updated list</p>";
        }
    }
}


if(isset($_POST['made'])) {
    //clean input data for sql 
    $rating = sanitizeMySQL($conn, $_POST['rating']);
    //query to add meal and date of meal into db 
    $query="INSERT INTO meal VALUES (NULL, $user, $id, CURDATE(), $rating)";
    $result = $conn->query($query);
    if (!$result) {
            die ("Database access failed: " . $conn->error);
        } else {
            echo "<p> Nice job cooking at home! </p>";
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
    <title> IHFAH: View this recipe</title>
</head>
<body>


<form method="post" action="">
    <fieldset>
        <legend>Add an Ingredient</legend>
        <label for="title">Name:</label>
        <input type="text" name="name" required><br> 
        <label for="ingredient_amt">Amount in grams:</label> 
        <input type="text" name="ingredient_amt" required><br>
        <input type="submit" name="submit">
    </fieldset>
</form>

<form method="post" action="">
    <fieldset>
        <legend>I made this!</legend>
        <label for="title">My Rating:</label>
        <input type="text" name="rating" required><br> 
        <input type="submit" name="made">
    </fieldset>
</form>


<a href="profile.php">Back to your profile</p>
<a href="recipes.php">Back to your recipes</p>
</body>
</html>