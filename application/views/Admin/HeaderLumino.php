<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>

<link href="<?php echo base_url('assets/Lumino/');?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url('assets/Lumino/');?>css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url('assets/Lumino/');?>css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url('assets/Lumino/');?>js/lumino.glyphs.js"></script>

	<script src="<?php echo base_url('assets/Lumino/');?>js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url('assets/Lumino/');?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/Lumino/');?>js/chart.min.js"></script>
	<script src="<?php echo base_url('assets/Lumino/');?>js/chart-data.js"></script>
	<script src="<?php echo base_url('assets/Lumino/');?>js/easypiechart.js"></script>
	<script src="<?php echo base_url('assets/Lumino/');?>js/easypiechart-data.js"></script>
	<script src="<?php echo base_url('assets/Lumino/');?>js/bootstrap-datepicker.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>UPT - P2M</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $nama;?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo site_url('login/logout');?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="<?php echo site_url('admin2/');?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li><a href="<?php echo site_url('admin2/datalogin');?>"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Data Login</a></li>
			<li><a href="<?php echo site_url('admin2/PDF');?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Data PDF</a></li>
			<li><a href="<?php echo site_url('admin2/daftarkata');?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Kata Stop Word</a></li>
		</ul>

	</div><!--/.sidebar-->