<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>
    <?php echo $data['title']; ?>
    <p class="lead">
        <?php echo $data['description']; ?>
    </p>
    <p class="lead">
        Version: <strong><?php echo APPVERSION; ?></strong>
    </p>
</h1>
<?php require APPROOT . '/views/inc/footer.php'; ?>