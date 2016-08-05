<br />
<h1>Analítico</h1>
<br />

<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br /></p>
<p><strong>Fecha Ingreso:</strong> <?php echo $persona['fechaNac'] ?><br /></p>
<p><strong>Nacionalidad:</strong> <?php echo $persona['idNacionalidad']==1?"Argentino":"Uruguayo" ?></p>
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
      <td><a href="<?php echo url_for('personas/getanalitico?idc='.$plan['idCarrera']) ?>">Descargar</a></td>
      </tr> 
  <?php } ?>
</table>
<br />
  
<?php
if ($analitico){ ?> 
  <table class="stats" width="200px"border="1px">
  <thead>
    <tr>
      <td class="hed">Nombre</td>
      <td class="hed">Nota</td>
      <td class="hed">Libro</td>
      <td class="hed">Folio</td>
      <td class="hed">Fecha</td>
      <td class="hed">Condicion</td>
      <td class="hed">Curso</td>
    </tr>
  </thead>
  <?php 
     $arrYears = array (1 => "Primer año", 2 => "Segundo año", 3 => "Tercer año", 4 => "Cuarto año",  5 => "Quinto año", 6 => "Sexto año");
     $anioactual = 0; $promedio = 0; $cantidad = 0; $canti = 0;
     foreach($analitico as $analit){ 
         if ($anioactual != $analit['curso']){ 
           $anioactual = $analit['curso']; ?>
           <tr bgcolor="#666666"><td colspan="7" align="center"><b><?php echo $arrYears[$anioactual] ?></b></td></tr>
    <?php }?>    	 
   	  <tr>
      <td><?php echo $analit['nombre'] ?></td>
      <td><?php echo ($analit['nota']==null or $analit['nota']=="")?$analit['calificacion']:$analit['nota'] ?></td>
      <td><?php echo $analit['Libro'] ?></td>
      <td><?php echo $analit['folio'] ?></td>
      <td><?php echo $analit['fecha'] ?></td>
      <td><?php echo $analit['Condicion'] ?></td>
      <td><?php echo $analit['curso'] ?></td>
      </tr>
  <?php 
         if ($analit['calif']!="" || $analit['calif']!=0){
             $promedio+=$analit['calif']; 
             $canti++;
         }    
         $cantidad++;
     } ?>
 <tr><td  colspan="7"><strong>Promedio:</strong> <?php echo number_format($promedio/$canti, 2) ?></td></tr>
 <tr><td  colspan="7"><strong>Cant. Materias:</strong> <?php echo $cantidad ?></td></tr>
 </table>
<br />
 <?php
} ?> 
