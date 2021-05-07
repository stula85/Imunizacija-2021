<h1><?php echo $title; ?></h1>
<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-12 col-md-4"></div>
		<div class="col-sm-12 col-md-8">
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
	</div>	
</div>
<div class="col-sm-12 mt-10">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col" width="10">Id-Термина</th>
				<th scope="col">Име и презиме</th>
				<th scope="col">ЈМБГ/Број пасоша</th>
				<th scope="col">Термин вакцинације</th>
				<th scope="col">Тип (V=вакцинација, R=ревакцинација)</th>
				<th scope="col" class="text-right">Опције:</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($podaci as $podatak) : ?>
				<tr class="table-default">
					<?php echo($podatak['status'] == 'OK') ? '<td style="color: #28B62C;">' : '<td>'; ?><?php echo $podatak['id_termina']; ?></td>
					<?php echo($podatak['status'] == 'OK') ? '<td style="color: #28B62C;">' : '<td>'; ?><?php echo $podatak['ime'] . " " . $podatak['prezime']; ?></td>
					<?php echo($podatak['status'] == 'OK') ? '<td style="color: #28B62C;">' : '<td>'; ?><?php echo $podatak['jmbg_pasos']; ?></td>
					<?php echo($podatak['status'] == 'OK') ? '<td style="color: #28B62C;">' : '<td>'; ?><?php $date = date_create($podatak['datum_vrijeme']); echo date_format($date, 'd.m.Y.') . " " . date_format($date, 'H:i'); ?></td>
					<?php echo($podatak['status'] == 'OK') ? '<td style="color: #28B62C;">' : '<td>'; ?><?php echo $podatak['tip']; ?></td>
					<td width="200" class="text-right"><a href="<?php echo base_url('vakcinacije/pacijent/');?><?php echo $podatak['id_termina']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Детаљи"><i class="fas fa-search-plus"></i></a> <?php if($podatak['status'] == 'OK') : ?><a href="<?php echo base_url('vakcinacije/potvrda/');?><?php echo $podatak['id_termina']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Потврда" target="_blank"><i class="fas fa-print"></i></a><?php endif; ?></td></td>
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