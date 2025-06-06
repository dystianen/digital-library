<?= $this->extend('../layouts/l_auth') ?>
<?= $this->section('content') ?>
<div class="card card-plain">
  <div class="card-header pb-0 text-start">
    <h4 class="font-weight-bolder">Sign In</h4>
    <p class="mb-0">Enter your username and password to sign in</p>
  </div>

  <div class="card-body">
    <form role="form" method="POST" action="<?php echo base_url(); ?>login">
      <div class="mb-3">
        <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" name="username">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password_hash">
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember me</label>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
      </div>
    </form>
  </div>
  <div class="card-footer text-center pt-0 px-lg-2 px-1">
    <p class="mb-4 text-sm mx-auto">
      Don't have an account?
      <a href="<?= base_url('register') ?>" class="text-primary text-gradient font-weight-bold">Sign up</a>
    </p>
  </div>
</div>
<?= $this->endSection() ?>