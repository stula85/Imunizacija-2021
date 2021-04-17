		</div>
	</div>
	<section class="footer">
		<div class="container">
			<div class="row txt-md">
				&copy; &nbsp;2021. Развој и програмирање: &nbsp;<a href="https://stula.dev" target="_blank">Борислав Штулић</a>.&nbsp;Апликација је објављена под &nbsp;<a href="https://www.gnu.org/licenses/" target="_blank">ГНУ-овом општом јавном лиценцом верзија 3.</a>
			</div>
		</div>
	</section>
	<script src="<?php echo base_url();?>assets/backend/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/popper.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/custom.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/jquery.datetimepicker.full.js"></script>
	<script src="<?php echo base_url();?>assets/backend/select2/js/select2.full.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/select2/js/i18n/sr.js"></script>
	<script type="text/javascript">
		$('#datetimepicker').datetimepicker({
			format:'Y-m-d H:00:00'
			
		});
	</script>
	<?php if($this->router->fetch_class() == "opstine" || $this->router->fetch_class() == "opstine"): ?>
	<script type="text/javascript">
		function obrisiUnos($id) {
			var txt;
			var r = confirm("Да ли сте сигурни?");
			if (r == true) {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('opstine/obrisi/t'); ?>",
					data: { 'id_opstine': $id },
					dataType: "json",
					success: function(data) {
						location.reload();
					},
					error: function() {
						alert('Дошло је до грешке!');
					}
				});
			}
		}
	</script>
<?php endif; ?>
<?php if($this->router->fetch_class() == "oboljenja" || $this->router->fetch_class() == "oboljenja"): ?>
	<script type="text/javascript">
		function obrisiUnos($id) {
			var txt;
			var r = confirm("Да ли сте сигурни?");
			if (r == true) {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('oboljenja/obrisi/t'); ?>",
					data: { 'id_oboljenja': $id },
					dataType: "json",
					success: function(data) {
						location.reload();
					},
					error: function() {
						alert('Дошло је до грешке!');
					}
				});
			}
		}
	</script>
<?php endif; ?>
<?php if($this->router->fetch_class() == "korisnici" || $this->router->fetch_class() == "korisnici"): ?>
<script type="text/javascript">
	$('#generisiPwd').on('click', function(){
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('korisnici/generisi_lozinku/t'); ?>",
			dataType: "json",
			success: function(data) {
				$('#lozinka').val();
				$('#lozinka').val(data);
				$('#generisanaLozinka').html('<strong>Lozinka:</strong> ' + data);
			},
			error: function() {
				alert('Došlo je do greške');
			}
		});
	});
	function obrisiUnos($id) {
			var txt;
			var r = confirm("Да ли сте сигурни?");
			if (r == true) {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('korisnici/obrisi/t'); ?>",
					data: { 'id_korisnika': $id },
					dataType: "json",
					success: function(data) {
						location.reload();
					},
					error: function() {
						alert('Дошло је до грешке!');
					}
				});
			}
		}
</script>
<?php endif; ?>
</body>
</html>