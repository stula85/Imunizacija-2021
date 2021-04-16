<h1><?php echo $title; ?></h1>
<div class="col-sm-12 mt-10">
	<?php if(validation_errors()) : ?>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Грешка!</strong> <?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<div class="form-group">
		<a href="<?php echo base_url('oboljenja'); ?>" class="btn btn-secondary">Назад</a>
	</div>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_pacijent">Измјена уноса</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_pacijent">
			<?php echo form_open('oboljenja/edit'); ?>
			<input type="hidden" name="id_oboljenja" value="<?php echo $oboljenje['id_oboljenja']; ?>">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Назив општине или града:</label>
						<input name="oboljenje" type="text" class="form-control" placeholder="Унесите назив општине или града (*)" value="<?php echo $oboljenje['oboljenje']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
						<label>Опције:</label>
						<hr>
						<input type="submit" class="btn btn-outline-success" value="Сачувај"> <a href="<?php echo site_url('oboljenja'); ?>" class="btn btn-outline-danger">Одустани</a>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>