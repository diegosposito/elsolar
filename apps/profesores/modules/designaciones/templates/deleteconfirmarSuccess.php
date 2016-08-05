<br><div align="center">
<h1>Eliminar Designaci&oacuten</h1><br>
<form action="<?php echo url_for('designaciones/delete') ?>" method="post">
<input type="hidden" id="iddesignacion" name="iddesignacion" value="<?php echo $designacion[0]['iddesignacion']; ?>">
  <table cellspacing="0" class="stats" width="70%">
    <?php echo $form ?>
  <tr><td colspan="2" align="center"><input type="submit" value="Eliminar" /></td></tr>  
  </table>
</form>
</div>
<br>
 <table cellspacing="0" class="stats" width="70%">
 <tr><td colspan="2" align="center"></td></tr> 
     <tr><td colspan="2" align="center"><p>Profesor(a) seleccionado(a): <b><?php echo $designacion[0]['persona']; ?></b></p></td></tr>
     <tr><td colspan="2" align="center"><p>Catedra: <b><?php echo $designacion[0]['materia']; ?></b></p></td></tr>   
     <tr><td colspan="2" align="center"><p>Tipo Designaci&oacuten: <b><?php echo $designacion[0]['tipodesignacion']; ?></b></p></td></tr>   
     <tr><td colspan="2" align="center"><p>Categor&iacutea Designaci&oacuten: <b><?php echo $designacion[0]['categoriadesignacion']; ?></b></p></td></tr>   
     <tr><td colspan="2" align="center"><p>Plan Estudio: <b><?php echo $designacion[0]['carreraplan']; ?></b></p></td></tr>
     <tr><td colspan="2" align="center"><p>Fecha Inicio: <b><?php echo $designacion[0]['inicio']; ?></b></p></td></tr>      
     <tr><td colspan="2" align="center"><p>Fecha Fin: <b><?php echo $designacion[0]['fin']; ?></b></p></td></tr>            
 </table> 
<br>
  
  <br>
  <a href="<?php echo url_for('profesores/ver?idpersona='.$designacion[0]['idpersona']) ?>">Cancelar</a>
  <br><br>