<h1><?php echo $title; ?></h1>
<div class="col-sm-12 mt-10">
	<?php if(validation_errors()) : ?>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Грешка!</strong> <?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<div class="form-group">
		<a href="<?php echo base_url('vakcinacije'); ?>" class="btn btn-secondary">Назад</a>
	</div>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_pacijent">Подаци о пацијенту</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_pacijent">
			<?php echo form_open('vakcinacije/snimi'); ?>
			<input type="hidden" name="id_pacijenta" value="<?php echo $podaci['id_pacijenta']; ?>">
			<input type="hidden" name="id_termina" value="<?php echo $termin; ?>">
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
						<select style="border: 1px solid #ff0000;" name="id_vakcine" class="form-control" id="exampleSelect1">
							<option value="-1">Одаберите вакцину...</option>
							<?php foreach ($vakcine as $vakcina) : ?>
								<option value="<?php echo $vakcina['id_vakcine']; ?>"><?php echo $vakcina['naziv_vakcine']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Датум и вријеме прве дозе:</label>
						<input readonly type="text" name="datum_vrijeme_prve_doze" class="form-control" value="<?php if($imunizacija['datum_vrijeme_prve_doze']) { echo $imunizacija['datum_vrijeme_prve_doze']; } else { echo date("Y-m-d H:i:s"); } ?>"/>
					</div>
					<div class="form-group">
						<label>Број серије прве дозе: <span style='color: #ff0000;'>(*)</span></label>
						<input <?php if($imunizacija['serija_prve_doze']) { echo 'readonly'; } ?> type="text" name="serija_prve_doze" class="form-control" value="<?php if($imunizacija['serija_prve_doze']) { echo $imunizacija['serija_prve_doze']; } ?>"/>
					</div>
					<div class="form-group">
						<label>Датум и вријеме друге дозе:</label>
						<input readonly type="text" name="datum_vrijeme_druge_doze" class="form-control" value="<?php if($imunizacija['datum_vrijeme_prve_doze']) { echo date("Y-m-d H:i:s"); } ?>"/>
					</div>
					<div class="form-group">
						<label>Број серије друге дозе: <?php if($imunizacija['serija_prve_doze'] != '') { echo "<span style='color: #ff0000;'>(*)</span>"; } ?></label>
						<input <?php if($imunizacija['serija_prve_doze'] == '') { echo 'readonly'; } ?> type="text" name="serija_druge_doze" class="form-control" value=""/>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Опције:</label>
						<hr>
						<input type="submit" class="btn btn-outline-success btn-lg" value="Сачувај"> <a href="<?php echo site_url('vakcinacije'); ?>" class="btn btn-outline-danger btn-lg">Одустани</a>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>