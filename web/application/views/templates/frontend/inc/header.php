<!DOCTYPE html>
<html lang="sr">
<head>
	<meta charset="UTF-8">
	<title>Imunizacija 2021!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/bootstrap.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/mystyles.css">
	<script src="https://kit.fontawesome.com/60e7fe743a.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="#"><?php echo translateText("Имунизација 2021!"); ?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('imunizacija');?>"><?php echo translateText("Насловна");?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('o-aplikaciji');?>"><?php echo translateText("О апликацији");?></a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link active" href="<?php echo site_url('imunizacija/change_lang?lang=srpski&sublang=cir'); ?>" style="display: unset;">Ћирилица</a> <a class="nav-link active" href="" style="display: unset;">/</a> <a class="nav-link active" href="<?php echo site_url('imunizacija/change_lang?lang=srpski&sublang=lat'); ?>" style="display: unset;">Latinica</a></li>
			</ul>
		</div>
	</nav>
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