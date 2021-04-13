<h1><?php echo $title; ?></h1>
<div class="col-sm-12">
	<a href="<?php echo base_url('bd/korisnici_dodaj');?>" class="btn btn-success bijeli-txt">Dodaj novog</a>
</div>
<div class="col-sm-12 mt-10">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Ime i Prezime</th>
				<th scope="col">Broj telefona</th>
				<th scope="col">Email</th>
				<th scope="col">Opcije:</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($podaci as $podatak) : ?>
				<tr class="table-default">
					<td><?php echo $podatak['id_korisnika']; ?></td>
					<td><?php echo $podatak['ime'] . " " . $podatak['prezime']; ?></td>
					<td><?php echo $podatak['broj_telefona']; ?></td>
					<td><?php echo $podatak['email']; ?></td>
					<td width="200"><a href="<?php echo base_url('bd/korisnici_izmjeni/');?><?php echo $podatak['id_korisnika']; ?>" class="btn btn-info pull-left">Izmjena</a> <button onclick="deaktivirajKorisnika(<?php echo $podatak['id_korisnika'];?>)" class="btn btn-danger pull-left ml-10">Brisanje</button></td></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table> 
</div>