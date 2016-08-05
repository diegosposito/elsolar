<br />
<h1>Inscripción a Cursada</h1>
<br />

<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br />
<strong>Fecha Nacimiento:</strong> <?php echo $persona['fechanac'] ?> <br />
<strong>Nacionalidad:</strong> <?php echo $persona['idnacionalidad']==1?"Argentino":"Uruguayo" ?></p>

  <br />
  <table width="50%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Carrera</td>
      <td class="hed">Plan</td>
      <td class="hed">Titulo</td>
      <td class="hed" align="center">Acción</td>
    </tr>
  </thead>
   <?php 
   foreach($planes as $plan){
   	  ?>
   	  <tr>
      <td><?php echo $plan['nombre'] ?></td>
      <td><?php echo $plan['plan'] ?></td>
      <td><?php echo $plan['titulo'] ?></td>
            <td align="center">
                <form name="form_<?php echo $plan['idcarrera']; ?>" method="post" action="<?php echo url_for('cursada/getmateriascursar' ) ?>">  
                     <input type="hidden" name="idc" value="<?php echo $plan['idcarrera']; ?>">
                     <input type="hidden" name="ida" value="<?php echo $plan['idalumno']; ?>">
                     <input type="submit" value="Visualizar" title="Visualizar" id="Visualizar" class="form_consulta_enviar" name="Visualizar">
                </form>
            </td>
          </tr> 
  <?php } ?>
  </table>
  <br>
<?php if ($materiascursar){ ?> 
  <h1>Materias</h1><br />	 
  <p><?php echo "Fecha actual libre deuda: <b>".$libredeuda."</b>"; ?></p> 
  <br />	  
  <table width="40%" class="stats" cellspacing="0">
  <thead>
  	<?php if($mensaje) { ?>
      <tr>
      <td colspan="5" class="hed"><?php echo $mensaje ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td class="hed">Nombre</td>
      <td class="hed">Curso</td>
      <td class="hed" width="100" align="center">Estado</td>
     
    </tr>
  </thead>
  <?php foreach($materiascursar as $materia){ ?>
    <tr>
      <td><?php echo $materia->getMaterias() ?></td>
      <td><?php echo $materia['curso'] ?></td>
      <td width="100">
      <?php /*if($materia['inscripto'] == "1") { 
          echo "<p align='center' class='resaltar_verde'>Inscripto</p>";
       } elseif($materia['inscripto'] == "0" && (date("Y-m-d") > $libredeuda)) { 
      	   echo "<p align='center' class='resaltar_naranja'>No habilitado</p>";
       } elseif($materia['inscripto'] == "0" && (date("Y-m-d") <= $libredeuda)) { */
      /*
         if(in_array($materia['iddetalleplan'], array_values($materiasinscriptas))) { 
          echo "<p align='center' class='resaltar_verde'>Inscripto</p>";
       } elseif((in_array($materia['iddetalleplan'], array_values($materiasinscriptas))== 0) && (date("Y-m-d") > $libredeuda)) { 
      	   echo "<p align='center' class='resaltar_naranja'>No habilitado</p>";
       } elseif((in_array($materia['iddetalleplan'], array_values($materiasinscriptas))== 0) && (date("Y-m-d") <= $libredeuda)) {
       */

      if (in_array($materia['iddetalleplan'], $materiasinscriptas)) {
      	echo "SI";
      }
       ?>
			<form class="button" name="form_<?php //echo $plan['idCarrera']; ?> " method="post" action="<?php echo url_for('cursada/inscribir' ) ?>">  
				<input type="hidden" name="ida" value="<?php echo $sf_user->getAttribute('idalumno'); ?>">
				<input type="hidden" name="idm" value="<?php echo $materia['iddetalleplan']; ?>">
				<input type="submit" value="Inscribir" title="Inscribirse a Cursar" id="Inscribir" class="form_consulta_enviar" name="Inscribir">
			</form>   
      </td>  
    </tr> 
  <?php  } ?>
 </table>
<?php } ?> 
