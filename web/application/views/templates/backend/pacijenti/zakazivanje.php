<h1><?php echo $title; ?></h1>
<div class="col-sm-12 mt-10">
	<div class="form-group">
		<a href="<?php echo base_url('pacijenti'); ?>" class="btn btn-secondary">Назад</a>
	</div>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_pacijent">Подаци о пацијенту</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_pacijent">
			<?php echo form_open('pacijenti/zakazi_termin'); ?>
			<input type="hidden" name="id_pacijenta" value="<?php echo $podaci['id_pacijenta']; ?>">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Име и презиме:</label>
						<input readonly type="text" class="form-control" value="<?php echo $podaci['ime'] . " " . $podaci['prezime']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>ЈМБГ/Број пасоша:</label>
						<input readonly type="text" class="form-control" value="<?php echo $podaci['jmbg_pasos']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-8">
					<div class="form-group">
						<label>Унесите датум и вријеме<span style="color: #ff0000;">(*)</span>:</label>
						<input type="text" name="datum_vrijeme" class="form-control" value="" id="datetimepicker"/>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Опције:</label>
						<hr>
						<input type="submit" class="btn btn-outline-success btn-lg" value="Сачувај"> <a href="<?php echo site_url('pacijenti'); ?>" class="btn btn-outline-danger btn-lg">Одустани</a>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>