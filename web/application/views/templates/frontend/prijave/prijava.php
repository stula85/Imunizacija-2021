<div class="col-md-10 offset-md-1">
	<div class="card border-primary mb-3 card-lg mt-50">
		<div class="card-header"><?php echo translateText("Имунизација 2021!"); ?></div>
		<div class="card-body">
			<h4 class="card-title"><?php echo translateText("Исказивање интересовања за вакцинисање против COVID-19"); ?></h4>
			<small id="jmbgNapomena" class="form-text text-danger"><?php echo validation_errors(); ?></small>
			<p class="card-text"><?php echo translateText("Напомена: Попуњавањем упитника не дајете сагласност за вакцинацију, већ искључиво исказујете интересовање."); ?></p>
			<p class="card-text text-danger"><?php echo translateText("Напомена: Сва поља означена (*) су обавезна!"); ?></p>
			<?php echo form_open('imunizacija/prijava'); ?>
			<div class="form-group">
				<label for="drzavljanstvo"><?php echo translateText("Одаберите опцију"); ?></label>
				<select class="form-control" id="drzavljanstvo" name="drzavljanstvo">
					<option value="<?php echo translateText("Држављанин Републике Босне и Херцеговине"); ?>"><?php echo translateText("Држављанин Републике Босне и Херцеговине"); ?></option>
					<option value="<?php echo translateText("Страни држављанин са боравком у Босни и Херцеговини"); ?>"><?php echo translateText("Страни држављанин са боравком у Босни и Херцеговини"); ?></option>
				</select>
			</div>
			<div class="form-group">
				<label for="jmbg" id="lblJmbg"><?php echo translateText("ЈМБГ(*)"); ?></label>
				<input type="text" name="jmbg_pasos" class="form-control" id="jmbg" placeholder="<?php echo translateText("Унесите ЈМБГ");?>">
				<small id="jmbgNapomena" class="form-text text-muted"><?php echo translateText("Ваша приватност нам је важна!"); ?> <a href="<?php echo site_url('politika-privatnosti'); ?>"><?php echo translateText("Сазнајте како се користе Ваши подаци"); ?></a>.</small>
			</div>
			<div class="form-group">
				<label for="ime"><?php echo translateText("Име(*)"); ?></label>
				<input type="text" name="ime" class="form-control" id="ime">
			</div>
			<div class="form-group">
				<label for="prezime"><?php echo translateText("Презиме(*)"); ?></label>
				<input type="text" name="prezime" class="form-control" id="prezime">
			</div>
			<div class="form-group">
				<label for="imejl"><?php echo translateText("Адреса електронске поште(*)"); ?></label>
				<input type="email" name="imejl" class="form-control" id="imejl">
			</div>
			<div class="form-group">
				<label for="brmob"><?php echo translateText("Број мобилног телефона(*)"); ?></label>
				<input type="text" name="brmob" class="form-control" id="brmob">
			</div>
			<div class="form-group">
				<label for="brfiks"><?php echo translateText("Број фиксног телефона"); ?></label>
				<input type="text" name="brfiks" class="form-control" id="brfiks">
			</div>
			<div class="form-group">
				<label for="opstina"><?php echo translateText("Одаберите локацију на којој желите да примите вакцину(*)"); ?></label>
				<select class="form-control" id="opstina" name="id_opstine">
					<?php foreach($opstine as $opstina) : ?>
						<option value="<?php echo $opstina['id_opstine']; ?>"><?php echo translateText($opstina['naziv_opstine']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="id_vakcine"><?php echo translateText("Исказујем интересовање да примим вакцину произвођача (*)"); ?></label>
				<select style="border: 1px solid #ff0000;" class="form-control" id="vakcina" name="id_vakcine">
					<option value="-1">Одаберите произвођача...</option>
					<?php foreach($vakcine as $vakcina) : ?>
						<option value="<?php echo $vakcina['id_vakcine']; ?>"><?php echo translateText($vakcina['naziv_vakcine']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<legend><?php echo translateText("Да ли имате неко од специфичних обољења?"); ?></legend>
				<div class="custom-control custom-radio">
					<input type="radio" id="oboljenja_ne" name="oboljenja" class="custom-control-input" checked="" value="0">
					<label class="custom-control-label" for="oboljenja_ne"><?php echo translateText("Не"); ?></label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="oboljenja_da" name="oboljenja" class="custom-control-input" value="1">
					<label class="custom-control-label" for="oboljenja_da"><?php echo translateText("Да"); ?></label>
				</div>
			</div>
			<div id="specificna_oboljenja" class="form-group">
				<legend><?php echo translateText("Означите уколико имате једно или више од наведених специфичних обољења:"); ?></legend>
				<?php foreach($oboljenja as $oboljenje) : ?>
					<div class="custom-control custom-checkbox">
						<input name="spisak_oboljenja[]" type="checkbox" class="custom-control-input" id="<?php echo $oboljenje['id_oboljenja']; ?>" value="<?php echo $oboljenje['id_oboljenja']; ?>">
						<label class="custom-control-label" for="<?php echo $oboljenje['id_oboljenja']; ?>"><?php echo translateText($oboljenje['oboljenje']); ?></label>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="form-group">
				<legend><?php echo translateText("Да ли због здравствених проблема не можете да излазите из куће/стана?"); ?></legend>
				<div class="custom-control custom-radio">
					<input type="radio" id="pokretan_da" name="pokretan" class="custom-control-input" checked="" value="1">
					<label class="custom-control-label" for="pokretan_da"><?php echo translateText("Не, немам таквих здравствених проблема"); ?></label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="pokretan_ne" name="pokretan" class="custom-control-input" value="0">
					<label class="custom-control-label" for="pokretan_ne"><?php echo translateText("Да, не могу да излазим из куће/стана"); ?></label>
				</div>
			</div>
			<div class="form-group">
				<legend><?php echo translateText("Да ли сте добровољни давалац крви?"); ?></legend>
				<div class="custom-control custom-radio">
					<input type="radio" id="davalac_ne" name="davalac_krvi" class="custom-control-input" checked="" value="0">
					<label class="custom-control-label" for="davalac_ne"><?php echo translateText("Не"); ?></label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="davalac_da" name="davalac_krvi" class="custom-control-input" value="1">
					<label class="custom-control-label" for="davalac_da"><?php echo translateText("Да"); ?></label>
				</div>
				<small id="jmbgNapomena" class="form-text text-danger"><?php echo translateText("* Приликом доласка у заказан термин вакцинације потребно је да донесете доказ да сте добровољни давалац крви!"); ?></small>
			</div>
			<div class="form-group">
					<input type="submit" class="btn btn-success" value="<?php echo translateText("Поднеси захтјев"); ?>">
					<a class="btn btn-danger" href="<?php echo site_url('imunizacija'); ?>"><?php echo translateText("Одустани"); ?></a>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>