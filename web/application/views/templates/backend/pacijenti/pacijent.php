<h1><?php echo $title; ?></h1>
<div class="col-sm-12 mt-10">
	<div class="form-group">
		<a href="<?php echo base_url('pacijenti'); ?>" class="btn btn-secondary">Назад</a>
	</div>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sadrzaj_pacijent">Подаци о пацијенту</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#sadrzaj_imunizacija">Имунизација пацијента</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content mt-10">
		<div class="tab-pane fade show active" id="sadrzaj_pacijent">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>Име и презиме:</label>
						<input readonly type="text" class="form-control" value="<?php echo $podaci['ime'] . " " . $podaci['prezime']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group">
						<label>ЈМБГ/Број пасоша:</label>
						<input readonly type="text" class="form-control" value="<?php echo $podaci['jmbg_pasos']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Контакт телефон (мобилни)</label>
						<input readonly type="text" class="form-control" value="<?php echo $podaci['brmob']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Контакт телефон (фиксни)</label>
						<input readonly type="text" class="form-control" value="<?php echo $podaci['brfiks']; ?>" />
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Контакт имејл</label>
						<input readonly type="text" class="form-control" value="<?php echo $podaci['imejl']; ?>" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-8">
					<div class="form-group">
						<label>Списак специфичних обољења:</label>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">ИД Обољења</th>
									<th scope="col">Назив обољења</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($oboljenja as $oboljenje) : ?>
									<tr class="table-default">
										<td><?php echo $oboljenje['id_oboljenja']; ?></td>
										<td><?php echo $oboljenje['oboljenje']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Инфо:</label>
						<ul class="list-group">
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Вакцина:
								<span class="badge badge-primary badge-pill"><?php echo $podaci['naziv_vakcine']; ?></span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Специфична обољења?
								<span class="badge badge-primary badge-pill"><?php echo ($podaci['oboljenja'] == 1) ? "Да" : "Не"; ?></span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Пацијент је покретан?
								<span class="badge badge-primary badge-pill"><?php echo ($podaci['pokretan'] == 1) ? "Да" : "Не"; ?></span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Пацијент је доб. давалац крви?
								<span class="badge badge-primary badge-pill"><?php echo ($podaci['davalac_krvi'] == 1) ? "Да" : "Не"; ?></span>
							</li>
						</ul>
					</div>
					<div class="form-group">
						<a href="<?php echo base_url('pacijenti/pozovi/') . $podaci['id_pacijenta'];?>" class="btn btn-success btn-lg" style="margin-left: 20px;"><i class="fas fa-calendar-plus"></i> Закажи термин вакцинације</a>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade show" id="sadrzaj_imunizacija">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="card border-primary mb-3">
						<div class="card-header">Подаци везани за заказану/спроведену имунизацију</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12 col-md-12">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col">Id</th>
												<th scope="col">Датум и вријеме</th>
												<th scope="col">Тип</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($termini_vakcinacije as $termin) : ?>
												<tr class="table-default">
													<td><?php echo $termin['id_termina']; ?></td>
													<td>
														<?php $date = date_create($termin['datum_vrijeme']); echo date_format($date, 'd.m.Y.') . " " . date_format($date, 'H:i'); ?>
													</td>
													<td><?php echo ($termin['tip'] == "V") ? "Вакцинација" : "Ревакцинација"; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table> 
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>