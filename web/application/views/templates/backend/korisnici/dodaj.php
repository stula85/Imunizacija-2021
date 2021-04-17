<h1><?php echo $title; ?></h1>
<div class="col-sm-12 mt-10">
	<?php if(validation_errors()) : ?>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Грешка!</strong> <?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<div class="form-group">
		<a href="<?php echo base_url('korisnici'); ?>" class="btn btn-secondary">Назад</a>
	</div>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_pacijent">Нови унос</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_pacijent">
			<?php echo form_open('korisnici/dodaj'); ?>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Име (*):</label>
						<input name="ime" type="text" class="form-control" placeholder="Име" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Презиме (*):</label>
						<input name="prezime" type="text" class="form-control" placeholder="Презиме" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Корисничко име (*):</label>
						<input name="korisnicko_ime" type="text" class="form-control" placeholder="Корисничко име" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Лозинка (*):</label>
						<input id="lozinka" name="lozinka" type="password" class="form-control" placeholder="" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label id="generisanaLozinka">Генеришите насумичну лозинку</label>
						<button id="generisiPwd" type="button" class="btn btn-outline-primary form-control">Генериши лозинку</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Адреса:</label>
						<input name="adresa" type="text" class="form-control" placeholder="Адреса" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Град:</label>
						<input name="grad" type="text" class="form-control" placeholder="Град" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Број телефона (*):</label>
						<input name="broj_telefona" type="text" class="form-control" placeholder="Број телефона" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Имејл (*):</label>
						<input name="email" type="text" class="form-control" placeholder="Имејл" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Активан</label>
						<select name = "aktivan" class="form-control">
							<option value="1">Да</option>
							<option value="0">Не</option>
						</select>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Да ли је корисник администратор?</label>
						<select name = "admin_nivo" class="form-control">
							<option value="7">Да</option>
							<option value="1">Не</option>
						</select>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Да ли је корисник супер администратор?</label>
						<select name = "super_user" class="form-control">
							<option value="D">Да</option>
							<option value="N" selected>Не</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="form-group">
					<label>Опције:</label>
					<hr>
					<input type="submit" class="btn btn-outline-success" value="Сачувај"> <a href="<?php echo site_url('korisnici'); ?>" class="btn btn-outline-danger">Одустани</a>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
</div>