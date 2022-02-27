<?php


class Validator {


    function Clean($input, $flag = 0) {

        $input =  trim($input);

        if ($flag == 0) {
            $input =  filter_var($input, FILTER_SANITIZE_STRING);
        }
        return $input;
    }


    function validate($input, $flag) {

        $status = true;

        switch ($flag) {
            case 1:
                # code...
                if (empty($input)) {
                    $status = false;
                }

                break;

            case 2:
                # Code ... 
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    $status = false;
                }
                break;


            case 3:
                # Code .... 
                if (strlen($input) < 6) {
                    $status = false;
                }
                break;

            case 4:
                # Code .... 
                if (!filter_var($input, FILTER_VALIDATE_INT)) {
                    $status = false;
                }
                break;

            case 5:
                # Code .... 


                $nameArray =  explode('.', $input);
                $imgExtension =  strtolower(end($nameArray));

                $allowedExt = ['png', 'jpg'];

                if (!in_array($imgExtension, $allowedExt)) {
                    $status = false;
                }
                break;

            case 6:
                # code ... 
                $date = explode('-', $input);

                if (!checkdate($date[1], $date[2], $date[0])) {
                    $status = false;
                }

                break;


            case 7:
                # code .... 
                $date = strtotime($input);

                if ($date <= time()) {
                    $status = false;
                }
                break;



            case 8:     // te stt     
                #code ..... 
                if (!preg_match('/^[a-zA-Z\s]*$/', $input)) {
                    $status = false;
                }
                break;



            case 9:     // te stt     
                #code ..... 
                if (!preg_match('/^01[0-2,5][0-9]{8}$/', $input)) {
                    $status = false;
                }
                break;
        }

        return $status;
    }
}
