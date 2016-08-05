<br><div align="center">
<h1>Designaciones de Profesores</h1><br>
<form action="<?php echo url_for('designaciones/show') ?>" method="post">
  <table cellspacing="0" class="stats" width="70%">
    <?php echo $form ?>
  <tr><td colspan="2" align="center"><input type="submit" value="Buscar" /></td></tr>  
  </table>
</form>
</div>
<br>
 <table cellspacing="0" class="stats" width="70%">
 <tr><td colspan="2" align="center"></td></tr> 
     <?php if ($oPersona) { ?>
     <tr><td colspan="2" align="center"><p>Profesor(a) seleccionado(a): <b><?php echo $oPersona->getApellido().", ".$oPersona->getNombre(); ?></b></p><?php echo link_to("I M P R I M I R", 'designaciones/imprimir?iddesignacion='.$oPersona->getIdPersona(),'class="mhead"'); ?></td></tr>   
     <?php } ?>
 </table> 
<br>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="5%">Id</th>
      <td class="hed" align="center" width="30%">Catedra</th>
      <td class="hed" align="center" width="30%">Tipo Designacion</th>
      <td class="hed" align="center" width="10%">Inicio</th>
      <td class="hed" align="center" width="10%">Fin</th>
      <td class="hed" align="center" width="5%">Fech Ap.</th> 
      <td class="hed" align="center" width="10%">Acciones</th>  
    </tr>
  <?php if($designacioness){
         foreach ($designacioness as $designaciones): ?>
    <tr>
      <td align="center"><?php echo $designaciones['iddesignacion']; ?></td>
      <td align="left"><?php echo $designaciones['nombre']; ?></td>
      <td align="left"><?php echo $designaciones['descripcion']; ?></td>
      <td align="center"><?php echo $designaciones['inicio']; ?></td>
      <td align="center"><?php echo $designaciones['fin']; ?></td>
      <td align="center"><?php echo $designaciones['fechaaprobacion']; ?></td>
      <td align="center"><?php echo link_to("Editar", 'designaciones/edit?iddesignacion='.$designaciones['iddesignacion'],'class="mhead"'); ?></td>
    
  
    </tr>
        <?php endforeach;
       } ?>
</table>


  
  <br>
  <a href="<?php echo url_for('designaciones/new') ?>">Agregar nuevas designaciones</a>
  <br><br>