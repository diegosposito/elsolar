<script>
window.onload = function() {
  document.getElementById("display").focus();
};
</script>
<br/>
<h1 align="center">Agregar Observación : <?php echo $persona->getApellido().', '.$persona->getNombre(); ?></h1>
<br/>
<form name="guardarobservacion" id="guardarobservacion" action="<?php echo url_for('horarios/guardarobservacion') ?>" method="post">
<div id="contenido" align="center" >
<input type="hidden" name="id" value="<?php echo $horarios->getId(); ?>">
<input style="height: 25px;width: 400px; font-weight: bold;font-size: 16px;" type=text id="observaciones" name="observaciones" size="16">
<br><br>
<input style="background:#f79de7;height: 70px;width: 185px;font-size: 18px;" type=submit value="Guardar">
<br><br>
 <p align="center"><input type="button" style="background:#f79de7;height: 50px;width: 150px;font-size: 18px;" value="Volver sin guardar" onclick="location.href='<?php echo url_for('horarios/registro') ?>'"></p>
</div>
</form>