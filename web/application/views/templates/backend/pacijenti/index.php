<h1><?php echo $title; ?></h1>
<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-12 col-md-4">
			<?php echo form_open('pacijenti/filter_opstina'); ?>
			<div class="form-group">
				<select name="opstina" class="form-control" id="exampleSelect1">
					<option value="-1">Одаберите град/општину...</option>
					<?php foreach ($opstine as $opstina) : ?>
						<option value="<?php echo $opstina['id_opstine']; ?>"><?php echo $opstina['naziv_opstine']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-sm-12 col-md-8">
			<button class="btn btn-success bijeli-txt">Прикажи за одабрани град/општину</button>
			<?php echo form_close(); ?>
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
				<th scope="col" width="10">Id</th>
				<th scope="col">Име и презиме</th>
				<th scope="col">Држављанство</th>
				<th scope="col">ЈМБГ/Број пасоша</th>
				<th scope="col">Специфична обољења?</th>
				<th scope="col">Пацијент је покретан?</th>
				<th scope="col">Пацијент је доб. давалац крви?</th>
				<th scope="col" class="text-right">Опције:</th>
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
					<td width="200" class="text-right"><a href="<?php echo base_url('pacijenti/pacijent/');?><?php echo $podatak['id_pacijenta']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Детаљи"><i class="fas fa-search-plus"></i></a> <a href="<?php echo base_url('pacijenti/pozovi/');?><?php echo $podatak['id_pacijenta']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Пошаљи позив за вакцинацију"><i class="fas fa-envelope-open-text"></i></a> <button onclick="obrisiPacijenta(<?php echo $podatak['id_pacijenta'];?>)" class="btn btn-danger ml-10"><i class="fas fa-trash"></i></button></td></td>
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