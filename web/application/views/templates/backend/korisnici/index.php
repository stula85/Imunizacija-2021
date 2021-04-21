<h1><?php echo $title; ?></h1>
<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-12 col-md-4">
			<a href="<?php echo base_url('korisnici/dodaj'); ?>" class="btn btn-success my-2 my-sm-0">Додај нови унос</a>
		</div>
		<div class="col-sm-12 col-md-8">
			<div class="forma-desno">
				<?php
				$attributes = array('class' => 'form-inline my-2 my-lg-0');
				echo form_open('korisnici/pretraga_korisnika', $attributes);
				?>
				<input class="form-control mr-sm-2" type="search" placeholder="Претрага..." aria-label="Search" name="pretraga">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit">Претрага</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>	
</div>
<div class="col-sm-12 mt-10">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col" width="10">Id</th>
				<th scope="col">Име и презиме</th>
				<th scope="col">Корисничко име</th>
				<th scope="col">Имејл</th>
				<th scope="col" class="text-right">Опције</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($podaci as $podatak) : ?>
				<tr class="table-default">
					<td><?php echo $podatak['id_korisnika']; ?></td>
					<td><?php echo $podatak['ime'] . " " . $podatak['prezime']; ?></td>
					<td><?php echo $podatak['korisnicko_ime']; ?></td>
					<td><?php echo $podatak['email']; ?></td>
					<td width="200" class="text-right"><a href="<?php echo base_url('korisnici/izmjeni/');?><?php echo $podatak['id_korisnika']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Измјени"><i class="fas fa-edit"></i></a> <button onclick="obrisiUnos(<?php echo $podatak['id_korisnika'];?>)" class="btn btn-danger ml-10"><i class="fas fa-trash"></i></button></td></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table> 
</div>
<div class="col-lg-12 col-md-12">
	<nav aria-label="Navigacija">
		<?php echo $pagination; ?>
	</nav>
</div>