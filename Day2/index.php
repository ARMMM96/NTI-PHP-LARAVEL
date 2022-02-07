<?php


function printNextLetter(string $letter)
{   
    $next_letter = ++$letter; 
    $next_letter = $next_letter[0];
    echo   $next_letter;
}

echo printNextLetter('C');

?>