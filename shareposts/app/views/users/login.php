<?php require APP_ROOT . '/views/includes/header.php'; ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Login</h2>
      <p>Please fill out this form to login</p>
      <form action="<?php echo URL_ROOT; ?>/users/login" method="post">

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="" class="form-control form-control-lg <?php echo (!empty($data['email_err']) ? 'is-invalid' : '') ?>" value="<?php echo $data['email'] ?>">
          <span class="invalid-feedback"><?php echo $data['email_err'] ?></span>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="" class="form-control form-control-lg <?php echo (!empty($data['password_err']) ? 'is-invalid' : '') ?>" value="<?php echo $data['password'] ?>">
          <span class="invalid-feedback"><?php echo $data['password_err'] ?></span>
        </div>

        <div class="row">
          <div class="col">
            <input type="submit" value="Login" class="btn btn-success btn-block">
          </div>
          <div class="col">
            <a href="<?php echo URL_ROOT; ?>/users/register" class="btn btn-light btn-block">Don't have an account yet? Register!</a>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<?php require APP_ROOT . '/views/includes/footer.php'; ?>