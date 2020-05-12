<?php
session_start();
?>
<!doctype HTML>
<html> 
<head>
<title> IHFAH:Your profile </title>
</head>
<body>

<?php
//db credentials and style
//require_once 'login.php';
include 'header.php';
include 'style.php';


//connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//test for session start
 if (!isset($_SESSION['username']) || !isset($_SESSION['password']) ) {
    echo "nope";
    
}

//get username
$id= $_SESSION['user_id'];

$query = "SELECT * FROM `user` WHERE user_id = '$id'";

$result = $conn->query($query);
if (!$result) die("Fatal Error");

//show user's name in profile header 

while ($row = $result->fetch_assoc()) {
    echo "<h1> Hi, ". $row["username"]. ". This is your Profile </h1>"; 
}

echo "<h2> Here are your recipes. </h2>";

//query and display list of recipes 
$query="SELECT title from recipe where recipe_id = (SELECT recipe_id WHERE user_id='$id')";

$result = $conn->query($query);
if (!$result) die("Fatal Error");

while ($row = $result->fetch_assoc()) {
    echo $row["title"]."<p></p>";
}

echo "<h2> Here are the ingredients you have.</h2>";

//query and display list of ingredients which have a quantity of over 0g. 

$query="SELECT ingredient_id, name, amt_available FROM ingredient WHERE user_id = $id && amt_available > 0";
$result = $conn->query($query);
if (!$result) die("Fatal Error");
while ($row = $result->fetch_assoc()) {
    echo $row["name"].", ".$row["amt_available"]." grams<p></p>";
}

echo "<h2> Here are the meals you've had.</h2>";

//query and display meals

$query="SELECT * FROM recipe NATURAL JOIN meal WHERE user_id =$id";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

while ($row = $result->fetch_assoc()) {
    echo $row["title"].", ".$row["date"]."<p></p>";
}

?>

<a href='recipes.php'>View or Add Recipes</a>
<p></p>
<a href='ingredients.php'>View or Add Ingredients<a>
<p></p>
<a href="logout.php">Log Out</a>
</body>
</html>