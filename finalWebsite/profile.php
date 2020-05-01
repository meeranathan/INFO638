<html> 
<head>
<title> Your profile </title>
</head>
<body>

<?php

//db credentials and style
include 'header.php';

//connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

//get username - currently one user is hardcoded until login page is built out
$query = "SELECT * FROM `user` WHERE user_id = 1";

$result = $conn->query($query);
if (!$result) die("Fatal Error");

//show user's name in profile header 

while ($row = $result->fetch_assoc()) {
    echo "<h1> Hi, ". $row["username"]. ". This is your Profile </h1>"; 
}

//action buttons link to recipe, ingredients, and meal pages (with forms) that are not yet built

echo "<button>Add a Recipe</button>";
echo "<button>Add ingredients</button>";
echo "<button>Add a Meal</button>";

echo "<h2> Here are your recipes. </h2>";

//query and display list of recipes 
$query="SELECT title from recipe where recipe_id = (SELECT recipe_id FROM meal WHERE user_id=1)";

$result = $conn->query($query);
if (!$result) die("Fatal Error");

while ($row = $result->fetch_assoc()) {
    echo $row["title"];
}

echo "<h2> Here are the ingredients you have.</h2>";

//query and display list of ingredients 

$query="SELECT ingredient_id, name, amt_available FROM ingredient WHERE user_id = 1";
$result = $conn->query($query);
if (!$result) die("Fatal Error");
while ($row = $result->fetch_assoc()) {
    echo $row["name"].", ".$row["amt_available"]." grams<p></p>";
}

echo "<h2> Here are the meals you've had.</h2>";

//query and display meals - how do I get data from separate queries to print in the same while loop?
//goal is to make it so that meal and date are in the same row (relevant regardless of table format)

$query="SELECT title from recipe where recipe_id = (SELECT recipe_id FROM meal WHERE user_id=1)";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

while ($row = $result->fetch_assoc()) {
    echo $row["title"]."<p></p>";
}
$query="SELECT date from meal where user_id=1";
$result = $conn->query($query);
if (!$result) die("Fatal Error");
while ($row = $result->fetch_assoc()) {
    echo $row["date"]."<p></p>";
}




?>
</body>
</html>