<?php require APP_ROOT . '/views/includes/header.php'; ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Create an Account</h2>
      <p>Please fill out this form to register with us</p>
      <form action="<?php echo URL_ROOT; ?>/users/register" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" id="" class="form-control form-control-lg <?php echo (!empty($data['name_err']) ? 'is-invalid' : '') ?>" value="<?php echo $data['name'] ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APP_ROOT . '/views/includes/footer.php'; ?>