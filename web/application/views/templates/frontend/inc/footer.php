		</div>
	</div>
	<section class="footer">
		<div class="container">
			<div class="row txt-md">
				&copy; &nbsp;2021. <?php echo translateText("Развој и програмирање");?>: &nbsp;<a href="https://stula.dev" target="_blank"><?php echo translateText("Борислав Штулић");?></a>.&nbsp;<?php echo translateText("Апликација је објављена под"); ?> &nbsp;<a href="https://www.gnu.org/licenses/" target="_blank"><?php echo translateText("ГНУ-овом општом јавном лиценцом верзија 3."); ?></a>
				</div>
			</div>
		</section>
		<script src="<?php echo base_url();?>assets/frontend/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/frontend/js/popper.min.js"></script>
		<script src="<?php echo base_url();?>assets/frontend/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/frontend/js/custom.js"></script>
		<?php if($this->router->fetch_class() == "imunizacija" || $this->router->fetch_class() == "imunizacija"): ?>
		<script>
			$(document).ready(function($) {
				$('#specificna_oboljenja').hide();

				$('#drzavljanstvo').on('change', function() {
					var opcija = $(this).val();
					if(opcija == 'Страни држављанин са боравком у Босни и Херцеговини' || opcija == 'Strani državljanin sa boravkom u Bosni i Hercegovini') {
						$("#lblJmbg").html("<?php echo translateText("Број пасоша(*)"); ?>");
						$("#jmbg").attr('placeholder', '<?php echo translateText("Унесите број пасоша(*)"); ?>');
					} else {
						$("#lblJmbg").html("<?php echo translateText("ЈМБГ(*)"); ?>");
						$("#jmbg").attr('placeholder', '<?php echo translateText("Унесите ЈМБГ(*)"); ?>');
					}
				});
				$('#oboljenja_da').change(function () {
					if(this.checked == true) {
						$('#specificna_oboljenja').show();
					}
				});
				$('#oboljenja_ne').change(function () {
					if(this.checked == true) {
						$('#specificna_oboljenja').hide();
					}
				});
			});
		</script>
	<?php endif; ?>
</body>
</html>