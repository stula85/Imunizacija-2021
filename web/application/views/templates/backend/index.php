<div class="col-lg-12">
	<div class="page-header">
		<h1 id="containers">Имунизација 2021!</h1>
	</div>
	<div class="bs-component">
		<div class="jumbotron">
			<h1 class="display-3 centar"><?php echo $title; ?></h1>
			<p class="lead centar">Унесите приступне податке</p>
			<hr class="my-4">
			<?php echo form_open('prijava'); ?>
			<div class="col-md-4 offset-md-4">
				<div class="form-group">
					<label>Корисничко име:</label>
					<input type="text" name="korisnicko_ime" class="form-control">
				</div>
				<div class="form-group">
					<label>Лозинка:</label>
					<input type="password" name="lozinka" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Пријава у систем</button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>