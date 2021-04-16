<!DOCTYPE html>
<html lang="sr">
<head>
	<meta charset="UTF-8">
	<title>Imunizacija 2021!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/bootstrap.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/custom.css">
	<script src="https://kit.fontawesome.com/60e7fe743a.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/jquery-ui.css">
	<script src="<?php echo base_url();?>assets/backend/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/select2/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/css/jquery.datetimepicker.css"/>

</head>
<body>
	<?php if($this->session->userdata('prijavljen') && $this->session->userdata('admin_nivo') == "7") : ?>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="<?php echo site_url('panel'); ?>">Имунизација 2021!</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('panel'); ?>">Панел
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('pacijenti'); ?>">Пацијенти</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Шифрарници</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?php echo site_url('opstine'); ?>">Општине/Градови</a>
						<a class="dropdown-item" href="<?php echo site_url('oboljenja'); ?>">Обољења</a>
					</div>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link active" href="<?php echo site_url('panel/odjava/').$this->session->userdata('user_id'); ?>"><i class="fas fa-sign-out-alt"></i> Одјава из система</a></li>
			</ul>
		</div>
	</nav>
<?php endif; ?>
<div class="container">
	<div class="row">
		<div class="obavjestenje">
			<div class="col-sm-12">
				<?php if($this->session->flashdata('greska')): ?>
					<div class="alert alert-dismissible alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('greska'); ?>
					</div>
				<?php endif; ?>
				<?php if($this->session->flashdata('uspjeh')): ?>
					<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('uspjeh'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>