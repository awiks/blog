<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="<?php if(isset($keywords)) echo $keywords; ?>">
  <meta name="description" content="<?php if(isset($description)) echo $description; ?>">
  <meta name="author" content="<?php if(isset($author)) echo $author; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php if(isset($title)) echo $title; ?></title>
  <link rel="icon" href="<?= site_url('asset/public/img/favicon.ico') ?>">
  <link href="<?= base_url('asset/public/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="<?= base_url('asset/public/vendor/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('asset/public/css/style.css') ?>">

  <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
    <header id="header" class="header-area">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow fixed-top">
            <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-laptop-code rotate-n-15"></i> CatatanKoding
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="fa fa-bars" style="color:#3f51b5"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('')?>">Home</a>
                </li>
                <li class="nav-item <?= $this->uri->segment(1) == 'about' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('/about')?>">About</a>
                </li>
                <li class="nav-item <?= $this->uri->segment(1) == 'articles' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('/articles')?>">Articles</a>
                </li>
                <li class="nav-item <?= $this->uri->segment(1) == 'portofolio' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('/portofolio')?>">Portofolio</a>
                </li>
                <li class="nav-item <?= $this->uri->segment(1) == 'contact' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url('/contact')?>">Contact</a>
                </li>
              </ul>
            </div>
            </div>
          </nav>
    </header>

  <?php 
    if(isset($content))$this->load->view($content);
  ?>


<footer class="footer">
  <div class="container">
    <span class="text-muted">Copyright &copy; <?= date('Y') ?>  All rights reserved</span>
  </div>
</footer>

<a href="#" class="scrollUp">
	<i class="fa fa-angle-up"></i>
</a>

<script src="<?= base_url('asset/public/js/jquery.min.js')?>" type="text/javascript"></script> 

<script src="<?= base_url('asset/public/vendor/bootstrap/js/bootstrap.bundle.min.js')?>" type="text/javascript"></script>
       
<script src="<?= base_url('asset/public/js/jquery.tosrus.min.all.js')?>" type="text/javascript"></script>

<script src="<?= base_url('asset/public/js/jquery.easing.min.js')?>" type="text/javascript"></script>

<?php if(isset($javascript))$this->load->view($javascript); ?>

<script type="text/javascript">
  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.scrollUp').fadeIn('slow');
    } else {
      $('.scrollUp').fadeOut('slow');
    }
  });

  $('.scrollUp').click(function() {

    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });
</script>

</body>
</html>