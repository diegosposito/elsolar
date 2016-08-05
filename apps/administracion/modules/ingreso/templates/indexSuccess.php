<div id="column2">
	<br>
	<h1>Bienvenido</h1>
	<?php if($usuario) { ?>
		<br>
		<h3><b><?php echo $area; ?></b></h3>
		<p>Se accedio con el e-mail:<b><?php echo $usuario; ?></b><br><br>
	<?php } else {?>
		<p>Bienvenido al Sistema de Alumnos de la Universidad de Concepción del Uruguay.</p><br>
	<?php } ?>
</div>