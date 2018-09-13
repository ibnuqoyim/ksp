<!DOCTYPE html>
<html lang="en">

<head><title>Login | <?=config_item('web_title')?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=base_url('template/assets/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('template/assets/font-awesome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('template/css/flaty.css')?>">
    <link rel="stylesheet" href="<?=base_url('template/css/flaty-responsive.css')?>">



</head>
<body class="login-page">
<?php
	$logo = base_url('template/images/logo2.jpg');
?>

	<div class="login-wrapper">
    		<div align="center">
                <!--img class="nav-user-photo" src="<?php //echo $logo?>" width="200px" /-->
            </div>
            <br/>
		<form action="<?=site_url('logins/login_process')?>" class="form" id="login-form" method="post">
            <h4>Login to <?=config_item('web_title')?></h4>
            <hr/>
            <div class="form-group">
            <?php
			if($pesan!=''){
			?>
            <div class="alert alert-warning">
            <strong>Peringatan!</strong>
            <?php echo $pesan?>
            </div>
            <?php
			}
			?>

				<div class="controls">
					<input type="text" placeholder="Username" id="username" name="username" value="<?=$username?>"  class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<div class="controls">
					<input type="password" placeholder="Password" id="password" name="password" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<div class="controls">
					<button type="submit" class="btn btn-danger form-control">Masuk</button>
				</div>
			</div>
        </form>
	</div> <!-- end login -->

<script>window.jQuery || document.write('<script src="<?=base_url('template/assets/jquery/jquery-2.0.3.min.js')?>"><\/script>')</script>
<script src="<?=base_url('template/assets/bootstrap/js/bootstrap.min.js')?>"></script>

<script src="<?=base_url('template/assets/jquery-validation/dist/jquery.validate.min.js')?>"></script>
<script src="<?=base_url('template/js/login/login.js')?>"></script>
</body>
</html>