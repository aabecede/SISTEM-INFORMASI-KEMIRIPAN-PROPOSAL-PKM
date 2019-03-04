<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="<?php echo base_url('assets/lumino/')?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url('assets/lumino/')?>css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in PKM</div>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('login/proses');?>">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" required="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
							</div>
							
							<input type="submit" class="btn btn-primary" value="Login">
						</fieldset>
					</form>
					<?php echo @$alert;?>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

</body>

</html>
