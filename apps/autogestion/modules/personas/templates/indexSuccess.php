<br />
<h1>Consulta de Saldos</h1>
<br />
<h2>IMPORTANTE:</h2>
<br /> 
Este sistema permite consultar el estado del alumnos en sus pagos arancelarios, para todos los alumnos Activos en el sector Administrativo. Si en la búsqueda de Alumnos, no se obtienen resultados (el alumno no figura en la lista), se deberá pedir que dichos Alumnos soliciten el papel LIBREDEUDA, dado que susituación lo requeire. 
<br /> 

 <form action="<?php echo url_for('personas/index') ?>" method="post">
 <p>Filtros: <b> <?php echo str_repeat("&nbsp;", 1) ?> apellido, nombre  <?php echo str_repeat("&nbsp;", 2) ?> <?php echo str_repeat("&nbsp;", 2) ?> / <?php echo str_repeat("&nbsp;", 2) ?> Dni </b></p>
 <table>
    <tr>
      <td><input style="width:120px" type="text" name="apellido" id="apellido" /> /</td>
      <td><input style="width:120px" type="text" name="dni" id="dni" /></td>
      <td><input style="width:120px" type="submit" value="Buscar" /></td>
    </tr>
  </table>
  <br />
  
  <?php if ($_POST ){ ?>
  <table width="50%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Nombre</td>
      <td class="hed">Dni</td>
      <td class="hed">Carrera</td>
      <td class="hed">Acciones</td>
    </tr>
  </thead>
   <?php 
   foreach($personas as $persona){
   	  ?>
   	  <tr>
      <td><?php echo $persona['nombre'] ?></td>
      <td><?php echo $persona['ndni'] ?></td>
      <td><?php echo $persona['descripcion'] ?></td>
      <td><a href="<?php echo url_for('personas/index?idpersona='.$persona['id'].'&nombre='.$persona['nombre']) ?>">Ver Estado</a></td>
      </tr> 
  <?php } ?>
  </table>
  <?php } ?>
  <br>
  
  <?php if ($_GET){ ?>

  <table width="50%" class="stats1" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Alumno: <? echo $alumno; ?></td>
    </tr>
  </thead>

  <table width="50%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Carreras</td>
   
      <td class="hed">Permiso</td>
    </tr>
  </thead>
   <?php 
   foreach($cuentas as $cuenta){
   	  ?>
   	  <tr>
      <td><?php echo $cuenta[0] ?></td>

      <td><?php 
		if ($cuenta[4]>=date('Y-m-d')){ echo $cuenta[4]; } else { echo '<p class="resaltar_rojo">Consultar Administracion</p>'; };
	?></td>
      </tr> 
  <?php } ?>
  </table>
  <?php } ?>
</form>
