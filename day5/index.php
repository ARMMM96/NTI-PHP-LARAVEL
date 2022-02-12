<?php


function Clean($input, $flag = 0)
{

    $input =  trim($input);
    $input = htmlspecialchars($input);

    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_STRING);
    }
    return $input;
}




// Check For Submit
if (filter_has_var(INPUT_POST, 'sumbit')) {

    $errors = [];

    // Get Form Date
    $title = Clean($_POST['title']);
    $content = Clean($_POST['content']);

    // validate title
    if (empty($title)) {
        $errors['title'] = "Field Required";
    }
    // validate content
    if (empty($content)) {
        $errors['content'] = "Field Required";
    }

    //  validate Image 
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
                echo "<div class=\"alert alert-dismissible alert-success\"> image uploaded </div>";
            } else {
                echo 'Error In Uploading Try Again';
            }
        } else {
            echo 'InValid Extension';
        }
    } else {

        $errors['image'] = "Field Required"; // else condition always work even if there is an image

    }

    $file = 'file.txt';
    $handle = fopen($file, 'r');
    $blogs = fread($handle, filesize($file));
    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...
            echo "<div class=\"alert alert-danger\"> $key  $value; </div>";
        }
    } else {

        // Writing to file 
        $current = file_get_contents($file);
        $current .= "\nBlog title: $title \n";
        $current .= "\nBlog content: $content \n";
        file_put_contents($file, $current);
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css">
    <script src="scirpt.js"></script>
</head>

<body>
    <nav class="navbar navbar_default">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">My Website</a>
            </div>
        </div>
    </nav>
</body>
<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea type="text" name="content" class="form-control"> </textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>

        <br>
        <button type="submit" name="sumbit" class="btn btn-primary">Submit</button>
    </form>
    <div class="container">
        <br>
        <?php if (isset($blogs)) : ?>
            <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                <div class="card-body">
                    <p class="card-text"><?php echo $blogs ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>



</html>