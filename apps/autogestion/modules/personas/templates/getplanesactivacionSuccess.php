<br />
<h1>Activación en Ciclo Lectivo</h1>
<br />

<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br />
<strong>Fecha Nacimiento:</strong> <?php echo $persona['fechaNac'] ?> <br />
<strong>Nacionalidad:</strong> <?php echo $persona['idNacionalidad']==1?"Argentino":" ------- " ?></p>

  <br />

<br />
<p style="color:red; font-size:11px"><b>Importante!! </b> La activación en una cuenta implica que esta aceptando realizar actividades durante el ciclo lectivo vigente , por lo que tanto en el sector Académico como Adminstrativo, veran esta operación, si observa que se encuentra activado en una Carrera que no corresponde, informelo a la Facultad o al sector Administrativo.  </p>
<br />



  <table width="50%" class="stats" cellspacing="0">
  <thead>
    <tr>
      <td class="hed">Carrera</td>
      <td class="hed">Plan</td>
      <td class="hed">Titulo</td>
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

      <td align="center">
	<?php
//inscriptoCiclo
//if (in_array("Irix", $os))
$inscripto=false;
$idAlu=0;
foreach ($inscriptoCiclo as $idAlu  ) { 
    if($plan['idAl']==$idAlu) $inscripto=true; 

     }

 if(!$inscripto) 
           echo '<a href="inscribirciclolectivo?idpe='.$plan['idCarrera'].'&ida='.$plan['idAl'].'">Inscribir</a>';
else 
	   echo '<p style="color:red; font-size:11px">ACTIVO</p>';
 ?> 
</td>




	<?php  ?>
      </tr> 

  <?php } ?>
  </table>
  <br>
  

