<?php

require('config/config.php');
require('config/db.php');

// Check For Submit

if (isset($_POST['delete'])) {
    // Get Form Data
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);



    $query = "DELETE FROM posts WHERE id = {$delete_id}";

    if (mysqli_query($conn, $query)) {
        header('Location: ' . ROOT_URL . '');
    } else {
        echo 'ERROR ' . mysqli_error($conn);
    }
}



// get ID 
$id = mysqli_real_escape_string($conn, $_GET['id']);



// Create Query
$query = 'SELECT * FROM posts WHERE id = ' . $id;


// Get Result
$result = mysqli_query($conn, $query);


// Fetch data 
$post = mysqli_fetch_assoc($result);


// Free Result
mysqli_free_result($result);

// Close Connection
mysqli_close($conn);




?>

<?php include('inc/header.php'); ?>

<div class="container">
    <div class="card  bg-light">
        <a href="<?php echo ROOT_URL; ?>" class="btn btn-default">Back</a>
        <div class="card-header">
            <h1> <?php echo $post['title']; ?></h1>
        </div>
        <div class="card-body">
            <small>
                Created on <?php echo $post['created_at']; ?> by: <?php echo $post['author']; ?>
            </small>
            <p lass="card-text"><?php echo $post['body']; ?></p>
            <hr>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="pull-right">
                <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>

            <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-default">Edit</a>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>