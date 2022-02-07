<?php



echo "<h2> Electricity bill </h2>";



$units = 70;

const firstLimitPrice = 3.50;
const secondLimitPrice = 4.00;
const thirdLimitPrice = 5.50;


if($units >= 150  )
{
    echo "<h3>Price per unit 6.50</h3>";
    echo "<p>total: ". $units * thirdLimitPrice  . "</p>";
}else if ($units > 50 && $units < 150){
    echo "<h3>Price per unit 4.00</h3>";
    echo "<p>total: ". $units * secondLimitPrice . "</p>";
}else if ($units <= 50){
    echo "<h3>Price per unit 3.50/unit</h3>";
    echo "<p>total: " . $units * firstLimitPrice . "</p>";
}

?>