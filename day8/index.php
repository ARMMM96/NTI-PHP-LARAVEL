<?php

require('config/db.php');
require('healpers.php');
$now = new DateTime();

// Create Query
$query = 'SELECT * FROM task';

// Get Result
$resul = mysqli_query($conn, $query);

// Fetch data 
$tasks = mysqli_fetch_all($resul, MYSQLI_ASSOC);


// Free Result
mysqli_free_result($resul);

// Delete Post
if (isset($_POST['delete'])) {
    // Get Form Data
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);


    $sql = "SELECT image FROM task WHERE id = $delete_id";
    $op   = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($op);

    $query = "DELETE FROM task WHERE id = {$delete_id}";
    if (mysqli_query($conn, $query)) {
        unlink('./uploads/' . $data['image']);
    } else {
        echo 'ERROR ' . mysqli_error($conn);
    }
}



// Check For Submit

if (isset($_POST['submit'])) {
    // Get Form Data
    $title = mysqli_real_escape_string($conn, clean($_POST['title']));
    $content = mysqli_real_escape_string($conn, clean($_POST['content']));
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);



    # Validate ...... 

    $errors = [];

    if (empty($title)) {
        $errors['title'] = "Field Required";
    }
    if (empty($content)) {
        $errors['content'] = "Field Required";
    }

    # Validate Image ..... 
    if (empty($_FILES['image']['name'])) {

        $errors['Image']   = "Field Required";
    } else {

        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];
        $imgType  = $_FILES['image']['type'];

        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));
        $imgFinalName = time() . rand() . '.' . $imgExtension;
        $allowedExt = ['png', 'jpg'];

        if (!in_array($imgExtension, $allowedExt)) {
            $errors['Image']   = "Not Allowed Extension";
        }
    }
    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        # DB CODE .......  



        $disPath = 'uploads/' . $imgFinalName;

        if (move_uploaded_file($imgTemp, $disPath)) {



            $sql = "INSERT INTO task (title,content,image,start,end) values ('$title','$content','$imgFinalName','$start','$end')";

            $op  =  mysqli_query($conn, $sql);

            if ($op) {
                echo 'Raw Inserted';
            } else {
                echo 'Error Try Again ' . mysqli_error($conn);
            }
        } else {
            echo 'Errot Try Again ... ';
        }
    }
}


// Close Connection
mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <h1>Add Task</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <label for="start">Start date:</label>

                <input type="date" id="start" name="start" value="<?php echo $now->format('Y-m-d'); ?>" min="<?php echo $now->format('Y-m-d'); ?>" max="2023-12-31">
            </div>
            <div class="form-group">
                <label for="end">Ennd date:</label>
                <input type="date" id="end" name="end" value="<?php echo $now->format('Y-m-d'); ?>" min="<?php echo $now->format('Y-m-d'); ?>" max="2023-12-31">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>

    </div>


    <div class="container">
        <?php foreach ($tasks as $task) : ?>

            <div class="card  bg-light">
                <div class="card-header">
                    <h3>
                        <?php echo $task['title']; ?>
                    </h3>
                </div>
                <div class="card-body">

                    <div>
                        <img src="./uploads/<?php echo $task['image'];  ?>" height="150" width="150">
                        <p lass="card-text"><?php echo $task['content']; ?></p>
                    </div>
                    <small>
                        Created on: <?php echo  $task['start']; ?>, End on: <?php echo $task['end']; ?>
                    </small>
                </div>
            </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="pull-right">
                <input type="hidden" name="delete_id" value="<?php echo $task['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php endforeach; ?>
    </div>

</body>

</html>