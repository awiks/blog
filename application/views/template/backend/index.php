<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php if(isset($title)) echo $title; ?></title>
    <link rel="icon" href="<?= base_url('asset/public/img/favicon.ico') ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/dist/css/adminlte.min.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">

    <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/toastr/toastr.min.css') ?>">

  <!-- SELECT2 -->
  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/select2/css/select2.min.css') ?>">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/summernote/summernote-bs4.css') ?>">

  <link rel="stylesheet" href="<?= base_url('asset/backend/css/style.css') ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link bg-indigo" href="<?= base_url() ?>" target="_blank">
         <i class="fa fa-eye"></i> View Website
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="fas fa-user mr-2"></i>
          <span><?= $this->session->userdata('name') ?></span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <div class="dropdown-divider"></div>
          <a href="#Modal-add" data-toggle="modal" class="dropdown-item ubah">
            <i class="fas fa-cogs mr-2"></i> Ubah Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('cpanel/auth/logout') ?>" class="dropdown-item ">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>

        </div>

      </li>
    </ul>
  </nav>

  <aside class="main-sidebar elevation-3 sidebar-light-maroon">
    <a href="index3.html" class="brand-link navbar-light">
      <img src="<?= base_url('asset/backend/vendor/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CatatanKoding</span>
    </a>

    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">

      <nav>
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?= base_url('cpanel/dashboard') ?>" class="nav-link <?= $this->uri->segment(2) == 'dashboard' ? 'active': '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'master-data' ? 'menu-open': '' ?>">
            <a href="#" class="nav-link <?= $this->uri->segment(2) == 'master-data' ? 'active': '' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('cpanel/master-data/kategori') ?>" 
                   class="nav-link <?= $this->uri->segment(3) == 'kategori' ? 'active': '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('cpanel/master-data/tag') ?>" 
                   class="nav-link <?= $this->uri->segment(3) == 'tag' ? 'active': '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tag</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('cpanel/master-data/user') ?>" 
                   class="nav-link <?= $this->uri->segment(3) == 'user' ? 'active': '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'pages' ? 'menu-open': '' ?>">
            <a href="#" class="nav-link <?= $this->uri->segment(2) == 'pages' ? 'active': '' ?>">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('cpanel/pages/artikel') ?>" 
                   class="nav-link <?= $this->uri->segment(3) == 'artikel' ? 'active': '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Artikel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('cpanel/pages/about') ?>" 
                   class="nav-link <?= $this->uri->segment(3) == 'about' ? 'active': '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('cpanel/pages/portofolio') ?>" 
                   class="nav-link <?= $this->uri->segment(3) == 'portofolio' ? 'active': '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Portofolio</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('cpanel/profile') ?>" 
               class="nav-link <?= $this->uri->segment(2) == 'profile' ? 'active': '' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('cpanel/kontak') ?>" 
               class="nav-link <?= $this->uri->segment(2) == 'kontak' ? 'active': '' ?>">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Kontak
              </p>
            </a>
          </li>

        </ul>

      </nav>

    </div>
  </aside>

  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark"><?php if(isset($title)) echo $title; ?></h1>
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">

        <?php if(isset($content))$this->load->view($content); ?>

      </div>
    </section>
  </div>

  <footer class="main-footer">
    Copyright &copy; <?= date('Y') ?>.
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>

 <?php if(isset($modal))$this->load->view($modal); ?>

<!-- jQuery -->
<script src="<?= base_url('asset/backend/vendor/plugins/jquery/jquery.min.js') ?>"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('asset/backend/vendor/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('asset/backend/vendor/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('asset/backend/vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('asset/backend/vendor/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('asset/backend/vendor/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<!-- jquery-validation -->
<script src="<?= base_url('asset/backend/vendor/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('asset/backend/vendor/plugins/jquery-validation/additional-methods.min.js') ?>"></script>

<!-- Toastr -->
<script src="<?= base_url('asset/backend/vendor/plugins/toastr/toastr.min.js') ?>"></script>

<!-- select2 -->
<script src="<?= base_url('asset/backend/vendor/plugins/select2/js/select2.min.js') ?>"></script>

<!-- INPUT FILE -->
<script src="<?= base_url('asset/backend/vendor/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>

<!-- Summernote -->
<script src="<?= base_url('asset/backend/vendor/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('asset/backend/vendor/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('asset/backend/vendor/dist/js/adminlte.js') ?>"></script>

<?php if(isset($javascript))$this->load->view($javascript); ?>

</body>
</html>
