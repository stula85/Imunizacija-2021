<h1><?php echo $title; ?></h1>
<div class="col-sm-12 mt-10">
	<?php if(validation_errors()) : ?>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Greška!</strong> <?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<?php echo form_open_multipart('bd/korisnici_edit'); ?>
	<input type="hidden" name="id_korisnika" value="<?php echo $korisnik['id_korisnika'];?>">
	<div class="form-group">
		<button class="btn btn-success bijeli-txt">Sačuvaj</button>
		<a href="<?php echo base_url('bd/korisnici'); ?>" class="btn btn-secondary">Odustani</a>
	</div>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_clanka">Opšti podaci</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_clanka">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Ime</label>
						<input type="text" name="ime" class="form-control" placeholder="Unesite ime korisnika" value="<?php echo $korisnik['ime'];?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Prezime</label>
						<input type="text" name="prezime" class="form-control" placeholder="Unesite prezime korisnika" value="<?php echo $korisnik['prezime'];?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Adresa</label>
						<input type="text" name="adresa" class="form-control" placeholder="Unesite adresu" value="<?php echo $korisnik['adresa'];?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Grad</label>
						<input type="text" name="grad" class="form-control" placeholder="Unesite grad" value="<?php echo $korisnik['grad'];?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Broj telefona</label>
						<input type="text" name="broj_telefona" class="form-control" placeholder="Unesite broj telefona" value="<?php echo $korisnik['broj_telefona'];?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Email adresa</label>
						<input type="email" name="email" class="form-control" placeholder="Unesite email adresu" value="<?php echo $korisnik['email'];?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Korisničko ime</label>
						<input type="text" name="korisnicko_ime" class="form-control" placeholder="Unesite korisničko ime" value="<?php echo $korisnik['korisnicko_ime'];?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Lozinka</label>
						<input type="password" name="lozinka" class="form-control" placeholder="Unesite lozinku" />
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Aktivan</label>
						<select name = "aktivan" class="form-control">
							<option value="1" <?php if($korisnik['aktivan'] == 1) {echo "selected";}?>>Da</option>
							<option value="0" <?php if($korisnik['aktivan'] == 0) {echo "selected";}?>>Ne</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="card border-primary mb-12">
						<div class="card-header">Brčko distrikt</div>
						<div class="card-body">
							<div class="row">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tblosnovna_bd" <?php if($privilegije["tblosnovna"] == 1) : ?>checked<?php endif; ?>>
										Osnovna
									</label>
								</div>
							</div>
							<div class="row">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tblosnovdjelokruga_bd" <?php if($privilegije["tblosnovdjelokruga"] == 1) : ?>checked<?php endif; ?>>
										Osnov djelokruga
									</label>
								</div>
							</div> 
							<div class="row">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tbldjelokrug_bd" <?php if($privilegije["tbldjelokrug"] == 1) : ?>checked<?php endif; ?>>
										Djelokrug
									</label>
								</div>
							</div> 
							<div class="row">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tblnadzor_bd" <?php if($privilegije["tblnadzor"] == 1) : ?>checked<?php endif; ?>>
										Nadzor
									</label>
								</div>
							</div> 
							<div class="row">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="tblnapredno_bd" <?php if($privilegije["tblnapredno"] == 1) : ?>checked<?php endif; ?>>
										Napredno
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>