<?php require APP_ROOT . '/views/includes/header.php'; ?>

<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light">
  <i class="fa fa-backward"> Back</i>
</a>

<div class="card card-body bg-light mt-5">
  <?php flashMessage('post_message') ?>
  <h2>Add Post</h2>
  <p>Create a Post with this form</p>
  <form action="<?php echo URL_ROOT; ?>/posts/add" method="POST">

    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" name="title" id="" class="form-control form-control-lg <?php echo (!empty($data['title_err']) ? 'is-invalid' : '') ?>" value="<?php echo $data['title'] ?>">
      <span class="invalid-feedback"><?php echo $data['title_err'] ?></span>
    </div>

    <div class="form-group">
      <label for="body">Body:</label>
      <textarea type="text" name="body" id="" class="form-control form-control-lg <?php echo (!empty($data['body_err']) ? 'is-invalid' : '') ?>"><?php echo $data['body'] ?></textarea>
      <span class="invalid-feedback"><?php echo $data['body_err'] ?></span>
    </div>

    <input type="submit" value="submit" class="btn btn-success btn-block">

  </form>
</div>



<?php require APP_ROOT . '/views/includes/footer.php'; ?>