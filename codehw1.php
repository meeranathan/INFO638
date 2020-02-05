//code homework 1 
//meera nathan 

<!DOCTYPE html>
<html>
<head>
    <title> Code Homework 1 </title>
</head>

<body>
    <h1> Challenge 1: Correct Change </h1>

    <?php 

    $inputChange = 159;
    $dollars = (int) ($inputChange / 100);
    $leftAfterDollars = $inputChange % 100;
    $quarters = (int) ($leftAfterDollars / 25);
    $leftAfterQuarters = $leftAfterDollars % 25;
    $dimes = (int) ($leftAfterQuarters / 10);
    $leftAfterDimes = $leftAfterQuarters % 10;
    $nickels = (int) ($leftAfterDimes / 5);
    $leftAfterNickels = $leftAfterDimes % 5;
    $pennies = ($leftAfterNickels); 

    echo "You are due " . $inputChange . " cents in change. ";


    echo "You will get back ". $dollars ." dollar bill(s), ". $quarters ." quarter(s), ". $dimes. " dime(s), ". $nickels. " nickel(s), and ". $pennies. " pennie(s)" ;


    ?>

    <h1> Challenge 2: 99 Bottles of Beer </h1>

    <?php
    $bottles = 99;
    while ($bottles > 0 ) {
        echo $bottles. " bottles of beer on the wall. " .$bottles. " bottles of beer.";
        $bottles--;
        echo " Take one down, pass it around, ".$bottles. " bottles of beer on the wall."; 
        print "<p>";

    }
        


    ?>

 </body>


</html>