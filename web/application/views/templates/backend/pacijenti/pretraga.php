<h1><?php echo $title; ?></h1>
<div class="col-sm-12">
	<a href="<?php echo base_url('pacijenti');?>" class="btn btn-secondary">Очисти резултат претраге</a>
	<div class="forma-desno">
		<?php
		$attributes = array('class' => 'form-inline my-2 my-lg-0');
		echo form_open('pacijenti/pretraga_pacijenata', $attributes);
		?>
		<input class="form-control mr-sm-2" type="search" placeholder="Име, презиме, ЈМБГ/Пасош" aria-label="Search" name="pretraga">
		<button class="btn btn-secondary my-2 my-sm-0" type="submit">Претрага</button>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="col-sm-12 mt-10">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Име и презиме</th>
				<th scope="col">Држављанство</th>
				<th scope="col">ЈМБГ/Број пасоша</th>
				<th scope="col">Специфична обољења?</th>
				<th scope="col">Пацијент је покретан?</th>
				<th scope="col">Пацијент је доб. давалац крви?</th>
				<th scope="col">Опције:</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($podaci as $podatak) : ?>
				<tr class="table-default">
					<td><?php echo $podatak['id_pacijenta']; ?></td>
					<td><?php echo $podatak['ime'] . " " . $podatak['prezime']; ?></td>
					<td><?php echo $podatak['drzavljanstvo']; ?></td>
					<td><?php echo $podatak['jmbg_pasos']; ?></td>
					<td><?php echo ($podatak['oboljenja'] == 1) ? "Да" : "Не"; ?></td>
					<td><?php echo ($podatak['pokretan'] == 1) ? "Да" : "Не"; ?></td>
					<td><?php echo ($podatak['davalac_krvi'] == 1) ? "Да" : "Не"; ?></td>
					<td width="200"><a href="<?php echo base_url('pacijenti/pacijent/');?><?php echo $podatak['id_pacijenta']; ?>" class="btn btn-info pull-left" data-toggle="tooltip" data-placement="bottom" title="Детаљи"><i class="fas fa-search-plus"></i></a> <a href="<?php echo base_url('pacijenti/pozovi/');?><?php echo $podatak['id_pacijenta']; ?>" class="btn btn-info pull-left" data-toggle="tooltip" data-placement="bottom" title="Пошаљи позив за вакцинацију"><i class="fas fa-envelope-open-text"></i></a> <button onclick="obrisiPacijenta(<?php echo $podatak['id_pacijenta'];?>)" class="btn btn-danger pull-left ml-10"><i class="fas fa-trash"></i></button></td></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table> 
</div>