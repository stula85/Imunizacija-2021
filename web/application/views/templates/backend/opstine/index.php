<h1><?php echo $title; ?></h1>
<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-12 col-md-4">
			<a href="<?php echo base_url('opstine/dodaj'); ?>" class="btn btn-success my-2 my-sm-0">Додај нови унос</a>
		</div>
		<div class="col-sm-12 col-md-8">
			<div class="forma-desno">
				<?php
				$attributes = array('class' => 'form-inline my-2 my-lg-0');
				echo form_open('opstine/pretraga_opstine', $attributes);
				?>
				<input class="form-control mr-sm-2" type="search" placeholder="Унесите назив..." aria-label="Search" name="pretraga">
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
				<th scope="col">Id</th>
				<th scope="col">Назив општине / града</th>
				<th scope="col">Опције</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($podaci as $podatak) : ?>
				<tr class="table-default">
					<td><?php echo $podatak['id_opstine']; ?></td>
					<td><?php echo $podatak['naziv_opstine']; ?></td>
					<td width="200"><a href="<?php echo base_url('opstine/izmjeni/');?><?php echo $podatak['id_opstine']; ?>" class="btn btn-info pull-left" data-toggle="tooltip" data-placement="bottom" title="Измјени"><i class="fas fa-edit"></i></a> <button onclick="obrisiUnos(<?php echo $podatak['id_opstine'];?>)" class="btn btn-danger pull-left ml-10"><i class="fas fa-trash"></i></button></td></td>
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