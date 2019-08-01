<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.css') ?>">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>

    <title>Halaman Login</title>
  </head>
  <body>
  	<div class="back-judul">
    	<h2 class="text-center text-white" style="padding-top: 15%;">M-oneklik Login</h2>
    </div>

    <?php  

    	if($this->session->flashdata('login_gagal') == TRUE){ ?>
			<script>
				Swal.fire({
					type: 'error',
					title: 'Login Gagal!',
					text: '<?php echo $this->session->flashdata('login_gagal'); ?>'
				});
			</script>
    	<?php }	

    ?>

    <div class="row">
    	<div class="col-sm-8 align-self-center">
    		<div class="bungkus-kotak">
	    		<div class="card">
				  
				  <div class="card-body">
				    <h5 class="card-title text-center" style="color: #1382BD; text-transform: uppercase;">Login</h5><br>
				    <form action="<?php echo base_url('login/CekLogin') ?>" method="POST">
				    	<div class="bungkus-input">
					    	<div class="form-group">
							    <label class="label">username</label>
							    <input type="text" class="form-control" name="user">
							</div>
						</div>

						<div class="bungkus-input">
					    	<div class="form-group">
							    <label class="label">password</label>
							    <input type="password" class="form-control" name="pass">
							</div>
						</div>

						<button type="submit" class="btn-login">Login</button>

				    </form>
				  </div>
				
				</div>
			</div>
    	</div>
    </div>

    
    
  </body>
</html>