<?php


require('config/config.php');
require('config/db.php');


function clean($input, $flag = 0)
{

    $input =  trim($input);
    $input = htmlspecialchars($input);

    if ($flag == 0) {
        $input = htmlspecialchars($input);
    }
    return $input;
}



// Check For Submit

if (isset($_POST['submit'])) {



    // Get Form Data
    $title = mysqli_real_escape_string($conn, clean($_POST['title']));
    $body = mysqli_real_escape_string($conn, clean($_POST['body']));
    $author = mysqli_real_escape_string($conn, clean($_POST['author']));


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

    $query = "INSERT INTO posts(title,author,body) VALUES('$title','$author', '$body')";

    if (mysqli_query($conn, $query)) {
        header('Location: ' . ROOT_URL . '');
    } else {
        echo 'ERROR ' . mysqli_error($conn);
    }
}


?>

<?php include('inc/header.php'); ?>

<div class="container">
    <h1>Add Post</h1>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Titles</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label>image</label>
            <input type="file" name="body" class="form-control" id="image">
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </form>

</div>
<?php include('inc/footer.php'); ?>