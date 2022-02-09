<?php


function printNextLetter(string $letter)
{   
    $next_letter = ++$letter; 
    echo   $next_letter;
}

echo printNextLetter('e');

?>