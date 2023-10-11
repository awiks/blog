<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Auth</title>
	<link rel="icon" href="<?= base_url('asset/public/img/favicon.ico') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
   <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url('asset/backend/vendor/dist/css/adminlte.min.css') ?>">
</head>
<body class="login-page">
	
	<div class="login-box">

		<div class="login-logo">
		    <a><b>Cpanel </b>Catatan Koding</a>
		</div>

		<div class="card">
			<div class="card-header">
				<p class="login-box-msg">Sign in to start your session</p>
			</div>
			<div class="card-body">

				<?= $this->session->flashdata('message'); ?>

				<form id="login" action="<?= site_url('cpanel/auth') ?>" method="post">
					<div class="input-group mb-3">
			          <input type="email" name="email" class="form-control" placeholder="Email" required>
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-envelope"></span>
			            </div>
			          </div>
			        </div>

			        <div class="input-group mb-3">
			          <input type="password" name="password" class="form-control" placeholder="Password" required>
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-lock"></span>
			            </div>
			          </div>
			        </div>

			        <div class="row">
			          <div class="col-8">
			            <div class="icheck-primary">
			              <input type="checkbox" id="remember">
			              <label for="remember">
			                Show password
			              </label>
			            </div>
			          </div>
			          <!-- /.col -->
			          <div class="col-4">
			            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
			          </div>
			          <!-- /.col -->
			        </div>
					
				</form>

			</div>
			<div class="card-footer">
				<p class="text-center">&copy; Right Reserved CatatanKoding 2021</p>
			</div>
		</div>
	</div>

<!-- jQuery -->
<script src="<?= base_url('asset/backend/vendor/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('asset/backend/vendor/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- jquery-validation -->
<script src="<?= base_url('asset/backend/vendor/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('asset/backend/vendor/plugins/jquery-validation/additional-methods.min.js') ?>"></script>

<!-- AdminLTE App -->
<script src="<?= base_url('asset/backend/vendor/dist/js/adminlte.min.js') ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
  $(function(){

    $('[name=email]').val('');
    $('[name=password]').val('');

    $('#remember').click(function(){
      if($(this).is(':checked')){
        $('[name=password]').attr('type','text');
      }else{
        $('[name=password]').attr('type','password');
      }
    });

    $('#login').validate({
      errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    })
  });
</script>

</body>
</html>