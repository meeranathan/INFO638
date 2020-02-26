<!DOCTYPE html>
<html>
<head>
    <title> Code Homework 3 </title>
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
    <h1> Challenge 1: Book List </h1>

    <?php 


        $titles = array("PHP and MySQL Web Development", 
            "Web Design with HTML, CSS, JavaScript and jQuery", 
            "PHP Cookbook: Solutions & Examples for PHP Programmers",
            "JavaScript and JQuery: Interactive Front-End Web Development", 
            "Modern PHP: New Features and Good Practices",
            "Programming PHP");
        $authors = array("Luke Welling","Jon Duckett","David Sklar","Jon Duckett","Josh Lockhart", "Kevin Tatroe");
        $pages = array(144, 135, 14, 251, 7, 26);
        $types = array("Paperback","Paperback","Paperback","Paperback","Paperback","Paperback");
        $price = array(31.63, 41.23, 40.88, 22.09, 28.49, 28.96);

        $books = array($titles, $authors, $pages, $types, $price);

        print 

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