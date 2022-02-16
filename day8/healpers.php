<?php


function clean($input, $flag = 0)
{

    $input =  trim($input);
    $input = htmlspecialchars($input);

    if ($flag == 0) {
        $input = htmlspecialchars($input);
    }
    return $input;
}
