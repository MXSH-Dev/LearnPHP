<?php

include('./config/db_connect.php');

$pizza = null;

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location:index.php');
    } else {
        echo 'query error: ' . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM pizzas WHERE id=$id ";
    $result = mysqli_query($conn, $sql);
    $pizza = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<div class="container center">

    <?php if ($pizza) : ?>

        <h4>
            <?php echo htmlspecialchars($pizza['title']) ?>
        </h4>
        <p> Created by: <?php echo htmlspecialchars($pizza['email']) ?> </p>
        <p> Created at: <?php echo date($pizza['created_at']) ?> </p>
        <h5>Ingredients:</h5>
        <p> Created at: <?php echo htmlspecialchars($pizza['ingredients']) ?> </p>

        <!-- delete form -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
            <input type="submit" value="delete" name="delete" class="btn brand">
        </form>

    <?php else : ?>

        <h5 class="red-text"> No Such Pizza Exists! </h5>

    <?php endif ?>

</div>


<?php include('templates/footer.php') ?>

</html>