<?= $this->extend('../layouts/l_auth') ?>
<?= $this->section('content') ?>
<div class="card card-plain z-index-0">
  <div class="card-header pb-0 text-start">
    <h4 class="font-weight-bolder">Sign Up</h4>
    <p class="mb-0">Join now to explore and borrow books easily</p>
  </div>

  <div class="card-body">
    <?php
    /** @var \CodeIgniter\Validation\Validation|null $validation */
    $validation = session()->getFlashdata('validation');
    ?>
    <form role="form" method="POST" action="<?= base_url('register') ?>">
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?= old('username') ?>">
        <?php if ($validation && $validation->hasError('username')) : ?>
          <small class="text-danger"><?= $validation->getError('username') ?></small>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Fullname" name="full_name" value="<?= old('full_name') ?>">
        <?php if ($validation && $validation->hasError('full_name')) : ?>
          <small class="text-danger"><?= $validation->getError('full_name') ?></small>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <input type="password" class="form-control" placeholder="Password" name="password_hash">
        <?php if ($validation && $validation->hasError('password_hash')) : ?>
          <small class="text-danger"><?= $validation->getError('password_hash') ?></small>
        <?php endif; ?>
      </div>

      <div class="form-check form-check-info text-start">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
        </label>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign up</button>
      </div>

      <p class=" text-center text-sm mt-3 mb-0">Already have an account?
        <a href="<?= base_url('login') ?>" class="text-primary text-gradient font-weight-bold">Sign in</a>
      </p>
    </form>
  </div>
</div>
<?= $this->endSection() ?>