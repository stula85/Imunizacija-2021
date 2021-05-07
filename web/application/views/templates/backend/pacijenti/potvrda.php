<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Imunizacija 2021!</title>
	<style>
		body {
			font-family: firefly, DejaVu Sans, sans-serif;
			
		}
	</style>
</head>
<body>
<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 16px; font-weight: normal; text-align: center; border-bottom: 1px solid #000;"><b>ПОТВРДА О ИЗВРШЕНОЈ ВАКЦИНАЦИЈИ ПРОТИВ COVID-19</b><br>
<span style="color: #ccc;">POTVRDA O IZVRŠENOJ VAKCINACIJI <b>PROTIV COVID-19</b></span><br>
<span style="color: #ccc;">CONFIRMATION OF THE <b>COVID-19</b> VACCINATION</span></p>
<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 12px;">
	<b>Име и презиме:</b> <?php echo $ime . " " . $prezime; ?><br>
	<span style="color: #ccc;">Ime i prezime: <?php echo $ime . " " . $prezime; ?> / </span><span style="color: #ccc;">First and last name: <?php echo $ime . " " . $prezime; ?></span>
</p>
<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 12px;">
	<b>ЈМБГ:</b> <?php echo $jmbg_pasos; ?><br>
	<span style="color: #ccc;">JMBG: <?php echo $jmbg_pasos; ?> / </span><span style="color: #ccc;"> Personal. No.: <?php echo $jmbg_pasos; ?></span>
</p>
<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 12px;">
	<b>Датум давања и број серије прве дозе вакцине:</b> <?php $date = date_create($datum_vrijeme_prve_doze); echo date_format($date, 'd.m.Y.'); ?> , <b>серија:</b> <?php echo $serija_prve_doze; ?><br>
	<span style="color: #ccc;">Datum vakcinacije: <?php $date = date_create($datum_vrijeme_prve_doze); echo date_format($date, 'd.m.Y.'); ?> / </span><span style="color: #ccc;"> Vaccination Date: <?php $date = date_create($datum_vrijeme_prve_doze); echo date_format($date, 'd.m.Y.'); ?></span>
</p>
<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 12px;">
	<b>Датум давања и број серије друге дозе вакцине:</b> <?php if($datum_vrijeme_druge_doze != '0000-00-00 00:00:00') { $date = date_create($datum_vrijeme_druge_doze); echo date_format($date, 'd.m.Y.'); } ?> , <b>серија:</b> <?php echo $serija_druge_doze; ?><br>
	<span style="color: #ccc;">Datum druge vakcinacije: <?php if($datum_vrijeme_druge_doze != '0000-00-00 00:00:00') { $date = date_create($datum_vrijeme_druge_doze); echo date_format($date, 'd.m.Y.'); } ?> / </span><span style="color: #ccc;"> Second Vaccination Date: <?php if($datum_vrijeme_druge_doze != '0000-00-00 00:00:00') { $date = date_create($datum_vrijeme_druge_doze); echo date_format($date, 'd.m.Y.'); } ?></span>
</p>
<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 12px;">
	<b>Назив вакцине:</b> <?php echo $naziv_vakcine; ?><br>
	<span style="color: #ccc;">Naziv vakcine: <?php echo $naziv_vakcine; ?> / </span><span style="color: #ccc;"> Name of vaccine: <?php echo $naziv_vakcine; ?></span>
</p>
<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 12px;">
	<b>Датум издавања потврде:</b> <?php $date = date_create(); echo date_format($date, 'd.m.Y.'); ?><br>
	<span style="color: #ccc;">Datum izdavanja potvrde: <?php $date = date_create(); echo date_format($date, 'd.m.Y.'); ?> / </span><span style="color: #ccc;"> Confirmation Release Date: <?php $date = date_create(); echo date_format($date, 'd.m.Y.'); ?></span>
</p>
<div style="float:right;"><img src="<?php echo base_url();?>assets/backend/qr/<?php echo $id_termina; ?>.png"/></div>
<div style="clear: both;">
	<p style="font-family: firefly, DejaVu Sans, sans-serif; font-size: 12px;">Ова потврда важи без потписа и печата<br>
	<span style="color: #ccc;">Ova potvrda važi bez potpisa i pečata / This certificate is valid without signatures and seals</span></p>
</div>
</body>
</html>