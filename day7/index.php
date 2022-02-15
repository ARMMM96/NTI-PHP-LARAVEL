<?php


require('config/config.php');
require('config/db.php');

// Create Query
$query = 'SELECT * FROM posts ORDER BY created_at DESC';


// Get Result
$resul = mysqli_query($conn, $query);


// Fetch data 
$posts = mysqli_fetch_all($resul, MYSQLI_ASSOC);


// Free Result
mysqli_free_result($resul);

// Close Connection
mysqli_close($conn);


?>

<?php include('inc/header.php'); ?>

<div class="container">
    <h1>Posts Blog</h1>

    <?php foreach ($posts as $post) : ?>

        <div class="card  bg-light">
            <div class="card-header">
                <h3>
                    <?php echo $post['title']; ?>
                </h3>
            </div>
            <div class="card-body">
                <small>
                    Created on: <?php echo $post['created_at']; ?>, by: <?php echo $post['author']; ?>
                </small>
                <p lass="card-text"><?php echo $post['body']; ?></p>
                <a class="btn btn-primary" href="<? echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read More</a>
            </div>
        </div>

    <?php endforeach; ?>

</div>
<?php include('inc/footer.php'); ?>