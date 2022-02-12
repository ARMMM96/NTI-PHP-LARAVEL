<?php

session_start();


function Clean($input, $flag = 0)
{

    $input =  trim($input);

    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_STRING);   // <>>>>>
    }
    return $input;
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password'], 1);
    $email    = Clean($_POST['email']);
    $address    = Clean($_POST['address'], 1);
    $linkedin    = Clean($_POST['linkedin'], 1);


    # Validate ...... 

    $errors = [];

    # validate name .... 
    if (empty($name)) {
        $errors['name'] = "Field Required";
    }


    # validate email 
    if (empty($email)) {
        $errors['email'] = "Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email']   = "Invalid Email";
    }


    # validate password 
    if (empty($password)) {
        $errors['password'] = "Field Required";
    } elseif (strlen($password) < 6) {
        $errors['Password'] = "Length Must be >= 6 chars";
    }

    # validate address 
    if (empty($address)) {
        $errors['address'] = "Field Required";
    } elseif (strlen($address) < 10) {
        $errors['address'] = "Length Must be >= 10 chars";
    }

    # validate linkedin url 
    if (empty($linkedin)) {
        $errors['linkedin'] = "Field Required";
    } elseif (strlen($linkedin) < 10) {
        $errors['linkedin'] = "Length Must be >= 10 chars";
    }

    # validate Image 
    if (!empty($_FILES['image']['name'])) {
        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];
        $imgType  = $_FILES['image']['type'];

        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));

        $imgFinalName = time() . rand() . '.' . $imgExtension;

        $allowedExt = ['png', 'jpg'];


        

        if (in_array($imgExtension, $allowedExt)) {
            //  code .....  

            $disPath = 'uploads/' . $imgFinalName;

            if (move_uploaded_file($imgTemp, $disPath)) {
                echo 'File Uploaded';
            } else {
                echo 'Error In Uploading Try Again';
            }
        } else {
            echo 'InValid Extension';
        }
    } else {

        // $errors['image'] = "Field Required"; // else condition always work even if there is an image

    }



    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        echo 'Valid Data .... ';
        $_SESSION['Message']= "Welcome    ";

        $_SESSION['user'] = ["name" => $name, "email" => $email];
        
        header("Location: profile.php"); // throwing an error (Internal Server Error)    
    }
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
            </div>

            <div class="form-group">
                <label for="address">Linkedin Profile</label>
                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="Linkedin Profile ">
            </div>


            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <br>


</body>






</html>