<h1><?php echo $title; ?></h1>
<div class="col-sm-12 mt-10">
	<?php if(validation_errors()) : ?>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Грешка!</strong> <?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<div class="form-group">
		<a href="<?php echo base_url('vakcine'); ?>" class="btn btn-secondary">Назад</a>
	</div>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_pacijent">Измјена уноса</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_pacijent">
			<?php echo form_open('vakcine/edit'); ?>
			<input type="hidden" name="id_vakcine" value="<?php echo $vakcina['id_vakcine']; ?>">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Назив вакцине:</label>
						<input name="naziv_vakcine" type="text" class="form-control" placeholder="Унесите назив вакцине (*)" value="<?php echo $vakcina['naziv_vakcine']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label>Опције:</label>
						<hr>
						<input type="submit" class="btn btn-outline-success" value="Сачувај"> <a href="<?php echo site_url('vakcine'); ?>" class="btn btn-outline-danger">Одустани</a>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>