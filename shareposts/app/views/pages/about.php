<?php require APP_ROOT . '/views/includes/header.php';?>

<h1><?php echo($data['title']);?></h1>
<p class="lead"> <?php  echo($data['description']);?> </p>
<p class=""><strong>Version: <?php  echo(APP_VERSION);?> </strong></p>

<?php require APP_ROOT . '/views/includes/footer.php';?>