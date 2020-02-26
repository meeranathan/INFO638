<!DOCTYPE html>
<html>
<head>
    <title> Code Homework 3 </title>
    <style>
    body { 
        background-color: #03fcb6;
        color: #2f3634; 
        font-family: helvetica;
        border-style: dotted;
        padding-left: 10px; 

    }
    </style>
</head>

<body> 
    <h1> Challenge 1: Book List </h1>

    <?php 

        //initiallize book arrays
        $book1 = array("PHP and MySQL Web Development", "Luke Welling", 144, "Paperback", 31.63);
        $book2 = array("Web Design with HTML, CSS, JavaScript and jQuery", "Jon Duckett",135, "Paperback", 41.23);
        $book3 = array("PHP Cookbook: Solutions & Examples for PHP Programmers", "David Sklar", 14, "Paperback", 40.88);
        $book4 = array("Modern PHP: New Features and Good Practices", "Josh Lockhart", 7, "Paperback", 28.49);
        $book5 = array("PHP and MySQL Web Development", "Luke Welling", 144, "Paperback", 31.63);
        $book6 = array("Programming PHP", "Kevin Tatroe", 26, "Paperback", 28.96);

        //initialize full array
        $books = array($book1, $book2, $book3, $book4, $book5, $book6);

        //print and style table header
        echo "<table border = 1>";
        echo "<tr> <td> Title </td>
        <td> Author </td>
        <td> Pages</td>
        <td> Type </td>
        <td> Price ($) </td>
        </tr>";
        //loop through books 
        foreach ($books as $thing) {
            echo "<tr>";
            //loop through book information for each book
            foreach ($thing as $piece) {
                echo "<td>$piece </td>";
            }
            echo "</tr>";

        }
        echo "</table>";

        

    ?>

    <h1> Challenge 2: Coin Toss (but better this time) </h1>

    
    <?php


    function checkArray($input) { //helper function to determine if an array is all "heads"
        $stillGood = true;
        $j = 0;
        while($stillGood && ($j < sizeof($input))) {
                if ($input[$j] == 1) {
                    $stillGood = true;
                } else {
                    $stillGood = false;
                }
            $j++;
        }
        return $stillGood;
        
    }
    function doubleFlips($heads) {
        print "Flipping a cat. Hoping for ".$heads." heads in a row!";
        echo "<p>";
        $keepGoing = true; 
        //create an array to represent the latest flips
        $flipArray = array();
        //fill initial array with tails, make the array the same size as total heads needed to terminate the loop
        for ($i = 0; $i < $heads; $i++) {
            $flipArray[$i] = 0;
        }
        //initiaize variable for total number of flips 
        $count = 0; 
        //perform flip
        while ($keepGoing) {
            //generate heads or tails
            $current = mt_rand(0,1);
            $count++;
            //add latest flip to the flip array in the correct place
            $flipArray[$count % $heads] = $current;
            if(checkArray($flipArray) == 1) { //toss to helper function 
                //print images 
                ($current == 1) ? print "<img src='cat.png' width = 50 height = 50>" : print "<img src='cat-tail-png-19.png' width = 50 height = 50>" ;
                //terminate loop
                $keepGoing = false;
            } else {
                //print images
                ($current == 1) ? print "<img src='cat.png' width = 50 height = 50>" : print "<img src='cat-tail-png-19.png' width = 50 height = 50>" ;
            }               
        }

        //words
        echo "<p>";
        print "Flipped ".$heads." heads in a row in ".$count." flips.";
    }

    //call function
    echo doubleFlips(4);

    
    ?>

 </body>


</html>