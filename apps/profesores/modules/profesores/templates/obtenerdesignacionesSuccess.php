<script>

$(document).ready(function(){

  // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.idcase').attr('checked', this.checked);
    });

    if($('#idsede').val()!=0 && $('#idfacultad').val()!=0 && $('#activo').val()==0){
       $("#idaprobar").show();
    } else {
       $("#idaprobar").hide();
    }
    
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".idcase").click(function(){
        if($(".idcase").length == $(".idcase:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });  
   
});

</script>


<?php if (count($resultado) > 0){ ?> 
  <form action="<?php echo url_for('profesores/actualizarEstadoDesignaciones') ?>" method="post" id="formAprobar"> 
  <table cellspacing="0" class="stats" width="100%">
    <tr><td colspan="2" align="center">
              <div id="idaprobar" name="idaprobar" align="center"> 
                <input type="submit" value="Aprobar Designaciones" name="botonaprobar" id="botonaprobar" />
              </div> 
        </td>
    </tr>
  </table>            
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="4" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda.</td>
      </tr>
      <tr>
        <td width="2%" align="center" class="hed"><input type="checkbox" id="selectall" /></td>
        <td width="13%" align="center" class="hed">Persona</td>
        <td width="15%" align="center" class="hed">Carrera-Plan</td>
        <td width="15%" align="center" class="hed">Materia</td>
        <td width="15%" align="center" class="hed">Tipo</td>
        <td width="15%" align="center" class="hed">Fec.Inicio</td>
        <td width="15%" align="center" class="hed">Fec.Fin</td>
        <td width="5%" align="center" class="hed">Dedicaci&oacuten</td>
        <td width="5%" align="center" class="hed">Activa</td>
      </tr>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <td align="center"><input type="checkbox" class="idcase" name="idcase[]" value="<?php echo $item['iddesignacion'] ?>" <?php echo ($item['activo'])?"checked":""; ?> /></td>
        <td width="13%"><?php echo $item['persona'] ?></td>
        <td width="15%"><?php echo $item['carreraplan'] ?></td>
        <td width="15%"><?php echo $item['materia'] ?></td>
        <td width="15%"><?php echo $item['tipo'] ?></td>
        <td width="15%"><?php echo $item['inicio'] ?></td>
        <td width="15%"><?php echo $item['fin'] ?></td>
        <td width="5%"><?php echo $item['dedicacion'] ?></td>
       
        <?php if ($item['activo']==1){ ?>
          <td width="5%"><?php echo 'Si' ?></td>
        <?php } else { ?>
          <td bgcolor="#FF0000" width="5%"><?php echo 'No' ?></td>
        <?php } ?>
      
      </tr>
<?php } ?>
</table>
</form>
<?php } ?>