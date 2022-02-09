<?php

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (preg_match("/\S+/", $_POST['fname']) === 0) {
        $errors['fname'] = "* First Name is required.";
    }
    if (preg_match("/\S+/", $_POST['lname']) === 0) {
        $errors['lname'] = "* Last Name is required.";
    }
    if (preg_match("/.+@.+\..+/", $_POST['email']) === 0) {
        $errors['email'] = "* Not a valid e-mail address.";
    }
    if (preg_match("/.{6,}/", $_POST['password']) === 0) {
        $errors['password'] = "* Password Must Contain at least 6 Chanacters.";
    }
    if (preg_match("/\S+/", $_POST['address']) === 0) {
        $errors['address'] = "* Address  is required.";
    }
    if (preg_match("/\S+/", $_POST['linkedin']) === 0) {
        $errors['linkedin'] = "* Linkedin profile url is required.";
    }
    if (strcmp($_POST['password'], $_POST['confirm_password'])) {
        $errors['confirm_password'] = "* Password do not much.";
    }

    if (count($errors) === 0) {


        $_POST['password'] = '';
        $_POST['confirm_password'] = '';
        $_POST['fname'] = '';
        $_POST['lname'] = '';
        $_POST['email'] = '';
        $_POST['address'] = '';
        $_POST['linkedin'] = '';

        $successful = "<h4> You are successfully registered.</h4>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        #container {
            width: 760px;
            margin-left: auto;
            margin-right: auto;
        }

        .login {
            overflow: hidden;
            background: #01A9DB;
            padding: 5px;
        }

        .login table {
            float: right;
        }

        .form {
            overflow: hidden;
            padding: 5px;
        }

        .form table {
            margin-top: 15px;
            float: right;
        }

        #email,
        #linkedin,
        #address,
        #pw,
        #cpw {
            width: 317px;
            padding: 5px;
        }

        #fname,
        #lname {
            width: 150px;
            padding: 5px;
        }

        #submit {
            width: 140px;
            padding: 5px;
        }

        #submit:hover {
            background: #01A9DB;
            border-radius: 5px;
        }

        .footer {
            height: 15px;
            background: #01A9DB;
        }

        h1 {
            font: Tahoma, Geneva, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        h2 {
            font: Tahoma, Geneva, sans-serif;
            font-size: 11px;
            color: #F00;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        h3 {
            border: 1px solid #f0f0f0;
            font: "Courier New", Courier, monospace;
            font-size: 14px;
            color: #666;
            padding: 3px;
            margin: 0px;
        }

        #login_email,
        #login_password {
            width: 150px;
            padding: 5px;
            font: Tahoma, Geneva, sans-serif;
            font-size: 11px;
        }
    </style>

</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <td colspan="2">
                    <!-- This PHP script is will display the success message of the registration -->
                    <?php if (isset($successful)) {
                        echo $successful;
                    } ?>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="fname" id="fname" placeholder="First Name" value="<?php if (isset($_POST['fname'])) {
                                                                                                    echo $_POST['fname'];
                                                                                                } ?>"></td>
                <td><input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php if (isset($_POST['lname'])) {
                                                                                                    echo $_POST['lname'];
                                                                                                } ?>"></td>
            </tr>
            <tr>
                <td>
                    <!-- This PHP script will display when the form is submitted in First Name field is empty -->
                    <?php if (isset($errors['fname'])) {
                        echo "<h2>" . $errors['fname'] . "</h2>";
                    } ?>
                </td>
                <td>
                    <!-- This PHP script will display when the form is submitted in Last Name field is empty -->
                    <?php if (isset($errors['lname'])) {
                        echo "<h2>" . $errors['lname'] . "</h2>";
                    } ?>
                </td>
            </tr>
            <tr>
                <!-- The PHP Script in value attribute of the input below is use for value retrieval when registration fails due to validations -->
                <td colspan="2"><input type="text" name="email" id="email" placeholder="E-mail Address" value="<?php if (isset($_POST['email'])) {
                                                                                                                    echo $_POST['email'];
                                                                                                                } ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><?php if (isset($errors['email'])) {
                                    echo "<h2>" . $errors['email'] . "</h2>";
                                } ?></td>
            </tr>
            <tr>
                <td colspan="2"><input type="password" name="password" id="pw" placeholder="Password" value="<?php if (isset($_POST['password'])) {
                                                                                                                    echo $_POST['password'];
                                                                                                                } ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><?php if (isset($errors['password'])) {
                                    echo "<h2>" . $errors['password'] . "</h2>";
                                } ?></td>
            </tr>
            <tr>
                <td colspan="2"><input type="password" name="confirm_password" id="cpw" placeholder="Confirm Password" value="<?php if (isset($_POST['confirm_password'])) {
                                                                                                                                    echo $_POST['confirm_password'];
                                                                                                                                } ?>">
            </tr>
            <tr>
                <td colspan="2"><?php if (isset($errors['confirm_password'])) {
                                    echo "<h2>" . $errors['confirm_password'] . "</h2>";
                                } ?></td>
            </tr>

            <tr>
                <!-- The PHP Script in value attribute of the input below is use for value retrieval when registration fails due to validations -->
                <td colspan="2"><input type="text" name="address" id="address" placeholder="Address" value="<?php if (isset($_POST['address'])) {
                                                                                                                echo $_POST['address'];
                                                                                                            } ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><?php if (isset($errors['address'])) {
                                    echo "<h2>" . $errors['address'] . "</h2>";
                                } ?></td>
            </tr>
            <tr>
                <!-- The PHP Script in value attribute of the input below is use for value retrieval when registration fails due to validations -->
                <td colspan="2"><input type="url" name="linkedin" id="linkedin" placeholder="Linkedin" value="<?php if (isset($_POST['linkedin'])) {
                                                                                                                echo $_POST['linkedin'];
                                                                                                            } ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><?php if (isset($errors['linkedin'])) {
                                    echo "<h2>" . $errors['linkedin'] . "</h2>";
                                } ?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" id="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
</body>

</html>