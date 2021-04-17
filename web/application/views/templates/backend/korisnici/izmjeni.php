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
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_pacijent">Измјена уноса</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_pacijent">
			<?php echo form_open('korisnici/edit'); ?>
			<input type="hidden" name="id_korisnika" value="<?php echo $korisnik['id_korisnika']; ?>">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Име (*):</label>
						<input name="ime" type="text" class="form-control" placeholder="Име" value="<?php echo $korisnik['ime']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Презиме (*):</label>
						<input name="prezime" type="text" class="form-control" placeholder="Презиме" value="<?php echo $korisnik['prezime']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Корисничко име (*):</label>
						<input name="korisnicko_ime" type="text" class="form-control" placeholder="Корисничко име" value="<?php echo $korisnik['korisnicko_ime']; ?>" />
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
						<input name="adresa" type="text" class="form-control" placeholder="Адреса" value="<?php echo $korisnik['adresa']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Град:</label>
						<input name="grad" type="text" class="form-control" placeholder="Град" value="<?php echo $korisnik['grad']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Број телефона (*):</label>
						<input name="broj_telefona" type="text" class="form-control" placeholder="Број телефона" value="<?php echo $korisnik['broj_telefona']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Имејл (*):</label>
						<input name="email" type="text" class="form-control" placeholder="Имејл" value="<?php echo $korisnik['email']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Активан</label>
						<select name = "aktivan" class="form-control">
							<option value="1" <?php echo ($korisnik['aktivan'] == 1) ? 'selected' : ''; ?>>Да</option>
							<option value="0" <?php echo ($korisnik['aktivan'] == 0) ? 'selected' : ''; ?>>Не</option>
						</select>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Да ли је корисник администратор?</label>
						<select name = "admin_nivo" class="form-control">
							<option value="7" <?php echo ($korisnik['admin_nivo'] == 7) ? 'selected' : ''; ?>>Да</option>
							<option value="1" <?php echo ($korisnik['admin_nivo'] == 1) ? 'selected' : ''; ?>>Не</option>
						</select>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Да ли је корисник супер администратор?</label>
						<select name = "super_user" class="form-control">
							<option value="D" <?php echo ($korisnik['super_user'] == 'D') ? 'selected' : ''; ?>>Да</option>
							<option value="N" <?php echo ($korisnik['super_user'] == 'N') ? 'selected' : ''; ?>>Не</option>
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