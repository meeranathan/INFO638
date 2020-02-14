<!DOCTYPE html>
<html>
<head>
    <title> Code Homework 2 </title>
    <style>
    body { 
        background-color: #d6bfdd;
        color: #28004c;
        border-style: groove;
        border-width: 20px;
        border-color: pink;
        padding-left: 10px;
        font-family: OCR A Std, monospace;

    }
    </style>
</head>

<body> 
    <h1> Challenge 1: ISBN Validation </h1>

    <?php 


        function checkISBN($isbn) {
            $total = 0;
            if ( strlen($isbn) == 10 &&$isbn[9] == "X"  ) { // check if last number is X to avoid warning during loop
                $total = 10;
                for($i = 0; $i < 9; $i++) {
                $total = $total + ($isbn[$i] * (10-$i)); 
                } 

            } else if (strlen($isbn) == 10){
                for($i = 0; $i < 10; $i++) {
                $total = $total + ($isbn[$i] * (10-$i));
                }
               
            } else {
                $total = 1;
            }

            print "Checking ISBN: " .$isbn." for validity....";
            print "<p>";

            if ($total % 11 == 0) {
                print $isbn." is a valid ISBN.";
            } else {
                print $isbn." is not a valid ISBN";
            }
        }

        echo checkISBN("0970601980");

    ?>

    <h1> Challenge 2: Coin Toss </h1>

    <h2> Challenge 2a </h2>

    
    <?php

    function coinFlips($flips) {
        print "flipping a cat ".$flips." time(s)...";
        if ($flips < 0 || $flips > 9 && $flips % 2 == 0) {
            print "You can't flip a cat that many times";
        } else {
            
            print "<p>";
            for ($i = 0; $i < $flips; $i++){
                $result = mt_rand(0,1);
                if ($result == 1) {
                    echo "<img src='cat.png' width = 50 height = 50>";
                } else {
                    echo "<img src='cat-tail-png-19.png' width = 50 height = 50>";
                }
            }
        }        
    }

    echo coinFlips(1);
    echo "<p>";
    echo coinFlips(3);
    echo "<p>";
    echo coinFlips(5);
    echo "<p>";
    echo coinFlips(7);
    echo "<p>";
    echo coinFlips(9);
    echo "<p>";
    echo coinFlips(12);
    echo "<p>";

    print "<h2> Challenge 2b</h2>";


    function doubleFlips() {
        $keepGoing = true;
        $previous = mt_rand(0,1);
        ($previous == 1) ? print "<img src='cat.png' width = 50 height = 50>" : print "<img src='cat-tail-png-19.png' width = 50 height = 50>" ;
        while ($keepGoing) {
            $current = mt_rand(0,1);
            if($current == 1 && $previous==1) {
                ($current == 1) ? print "<img src='cat.png' width = 50 height = 50>" : print "<img src='cat-tail-png-19.png' width = 50 height = 50>" ;
                $keepGoing = false;
            } else {
                ($current == 1) ? print "<img src='cat.png' width = 50 height = 50>" : print "<img src='cat-tail-png-19.png' width = 50 height = 50>" ;
                $previous = $current; 
            }               
        }
    }

    echo doubleFlips();

    
    ?>

 </body>


</html>