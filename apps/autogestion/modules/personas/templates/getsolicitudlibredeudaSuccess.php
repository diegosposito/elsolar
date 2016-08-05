<br />
<h1>Solicitud Libredeuda</h1>
<br />

<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br />
<strong>Fecha  Nacimiento:</strong> <?php echo $persona['fechaNac'] ?> <br />
<strong>Nacionalidad:</strong> <?php echo $persona['idNacionalidad']==1?"Argentino":"Uruguayo" ?></p>

  <br />
  <table width="50%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Carrera</td>
      <td class="hed">Plan</td>
      <td class="hed">Titulo</td>
      <td class="hed">Fecha de libre deuda</td>
      <td class="hed">Acción</td>
    </tr>
  </thead>
   <?php 
   foreach($planes as $plan){
   	  ?>
   	  <tr>
      <td><?php echo $plan['nombre'] ?></td>
      <td><?php echo $plan['plan'] ?></td>
      <td><?php echo $plan['titulo'] ?></td>
      <td align="center"><?php echo $plan['fechalibredeuda'] ?></td>
    
      <td>   
        <?php if ($plan['fechalibredeuda']< date("Y-m-d")) { 

	?>
		<a href="<?php echo url_for('personas/getsolicitudlibredeuda?idc='.$plan['idCarrera']) ?>">Solicitar</a>
	<?php } ?>
	</td>
      </tr> 
  <?php } ?>
  </table>
  <br>
 

