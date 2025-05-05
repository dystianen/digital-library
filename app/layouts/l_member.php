<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Digital Library
  </title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg'); background-size: cover; background-attachment: fixed; background-position: center; position: relative;">
  <!-- Mask -->
  <span class="mask bg-gradient-primary opacity-6" style="position: absolute; top: 0; left: 0; width: 100%; height: 100vh; z-index: -1;"></span>
  <div class="position-fixed top-5 start-50 translate-middle p-3" style="z-index: 1100">
    <?php if (session()->getFlashData('failed')) : ?>
      <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
          <?= session("failed") ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashData('success')) : ?>
      <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
          <?= session("success") ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0">
          <div class="container-fluid">
            <a class="navbar-brand m-0 d-flex gap-2" href="<?= base_url('/') ?>">
              <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
              <h5 class="ms-1 font-weight-bold">Digital Library</h5>
            </a>
            <div>
              <?php if (!session()->has('username')) : ?>
                <ul class="navbar-nav d-lg-block d-none">
                  <li class="nav-item">
                    <a href="<?= base_url('login') ?>" class="btn btn-sm mb-0 me-1 btn-outline-primary">Sign In / Sign Up</a>
                  </li>
                </ul>
              <?php else : ?>
                <ul class="navbar-nav">
                  <li class="nav-item dropdown d-flex align-items-center">
                    <a class="nav-link text-dark font-weight-bold px-0 dropdown-toggle" onclick="showDropdown()" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-user me-sm-1"></i>
                      <span class="d-sm-inline"><?= session()->get('full_name') ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end d-none" aria-labelledby="navbarDropdown" id="userDropdown">
                      <li><a class="dropdown-item" href="<?= base_url('member/borrowed') ?>">Borrowed</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                    </ul>
                  </li>
                </ul>
              <?php endif; ?>

            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content mt-8" style="z-index: 99;">
    <?= $this->renderSection('content') ?>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    toastElList.map(function(toastEl) {
      const toast = new bootstrap.Toast(toastEl, {
        delay: 3000
      });
      toast.show();
    });

    function showDropdown() {
      const dropdowns = document.getElementsByClassName('dropdown-menu');
      if (dropdowns.length > 0) {
        const dropdown = dropdowns[0];
        dropdown.classList.remove('d-none'); // menghapus class d-none
      }
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>