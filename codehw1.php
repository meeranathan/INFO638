<!DOCTYPE html>
<html>
<head>
    <title> Code Homework 1 </title>
    <style>
    body { 
        background-color: #00c4b4;
        color: #6c6c6c;
        border-style: double;
        border-width: 10px;
        padding-left: 10px;

    }
    </style>
</head>

<body> 
    <h1> Challenge 1: Correct Change </h1>

    <?php 

    $inputChange = 132; // to test code, change input value here 

    if (gettype($inputChange) == "integer" && $inputChange > 0) { // check for correct input type and positive number
        //find number of dollars
        $dollars = (int) ($inputChange / 100);

        //find remainder after dollars 
        $leftAfterDollars = $inputChange % 100;

        //find number of quarters 
        $quarters = (int) ($leftAfterDollars / 25);

        //find remainder after quarters 
        $leftAfterQuarters = $leftAfterDollars % 25;

        //find number of dimes
        $dimes = (int) ($leftAfterQuarters / 10);

        //find remainder after dimes 
        $leftAfterDimes = $leftAfterQuarters % 10;

        //find number of nickles
        $nickels = (int) ($leftAfterDimes / 5);

        //find remainder after nickles 
        $leftAfterNickels = $leftAfterDimes % 5;

        //find number of pennies 
        $pennies = ($leftAfterNickels); 

        echo "You are due " . $inputChange . " cents in change. ";


        echo "You will get back ". $dollars ." dollar bill(s), ". $quarters ." quarter(s), ". $dimes. " dime(s), ". $nickels. " nickel(s), and ". $pennies. " pennie(s)" ;
    

    } else {
        echo "Please input an appropriate number of cents."; // output for inappropriate inputs 
    }
    

    ?>

    <h1> Challenge 2: 99 Bottles of Beer </h1>

    <img src="http://pngimg.com/uploads/beer/beer_PNG2372.png" align = "right">

    <?php
    // this answers both 2a and 2b 
    $bottles = 99; //to test code, change input value here 
    if (gettype($bottles)== "integer" && $bottles > 0) { //check for correct input type and positive number 
        while ($bottles > 0 ) { //loop through number of bottles until terminating case 
        echo $bottles. " bottles of beer on the wall. " .$bottles. " bottles of beer."; //print first half of verse
        $bottles--; // decrement bottles
        echo " Take one down, pass it around, ".$bottles. " bottles of beer on the wall."; //print second half of verse 
        print "<p>";
        }
    
    } else {
        echo "Please input an appropriate number of bottles."; //output for inappropriate inputs
    }
        


    ?>

 </body>


</html>