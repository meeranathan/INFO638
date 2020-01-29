<!DOCTYPE html>
<html>
<head>
    <title> Week 2 </title>
    <style> 
    body {
        background-color: #c6dbec;
        color: #00485d;
    }
    </style>

</head>
<body>
    <h1> Week 2 examples </h1>
    <p> This is my work! </p>
    <?php
        $windSpeed = 30.4;
        $windCharacter = "Light";
        $currentCondition = "It is $windCharacter and $windSpeed and your lunch was \$11.50";

    // double quotes allows string interpolation. single quotes
    //denotes the literal string. escape character makes the dollar sign a literal dollar sign.

        echo $currentCondition;
        print "<p>";

        $isNiceOut = true; 

        echo $isNiceOut;
        $mycalc = (int) (2453/255);
        print "<p> Result is: ".$mycalc;
        print "<p>";

        function showWeather () {
            echo "It's 20 degrees";
        }

        $weatherStructure = array(40.7, "Sunny");
        print_r($weatherStructure);
        print "<p>"; //or use CSS for defining rules for whitespace 
        //print_r($_SERVER);
        print "<p>";

        $firstName = "Meera";
        $middleName = "Raji";
        $lastName = "Nathan";

        $age = 26;

        echo "$lastName, $firstName $middleName ($age)";
        echo "<li>$lastName, $firstName $middleName ($age)</li>";
        
        $nameArray = array($firstName, $middleName, $lastName);
        //print_r ($nameArray);

        echo (int) $firstName;
        print "<p>";

        echo $lastName.", ".$firstName." ".$middleName." (". $age.")";
        print "<p>";

        $ageIn5 = $age + 5;

        echo $ageIn5;
        print "<p>";

        $ageDiff = 2034 - 2020;

        echo $ageDiff;
        print "<p>";

        $ageInMonths = 12*26 + 2;

        echo $ageInMonths;
        print "<p>";

        echo ++$age;

    ?>

</body>
</html>