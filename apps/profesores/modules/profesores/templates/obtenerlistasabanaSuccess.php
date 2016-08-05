<script>

$(document).ready(function(){

  // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.idcase').attr('checked', this.checked);
    });

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
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="4" width="100%"><b>Se han encontrado <?php echo count($resultado); ?> designaciones en estado Visadas.</b></td>
      </tr>
      <tr>
        <?php if ($permite_seleccionar=='1'){ ?>
          <td width="2%" align="center" class="hed"><input type="checkbox" id="selectall" /></td>
        <?php } ?>

        <td width="5%" align="center" class="hed">Sede</td>
        <td width="15%" align="center" class="hed">Carrera-Plan</td>
        <td width="15%" align="center" class="hed">Profesor</td>
        <td width="15%" align="center" class="hed">Materia</td>
        <td width="9%" align="center" class="hed">Tipo</td>
        <td width="8%" align="center" class="hed">Categoría</td>
        <td width="9%" align="center" class="hed">Inicio</td>
        <td width="9%" align="center" class="hed">Fin</td>
        <td width="5%" align="center" class="hed">Dedicaci&oacuten</td>
        <td width="5%" align="center" class="hed">Resoluci&oacuten</td>
    </tr>
    </thead>
    <tbody>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <?php if ($permite_seleccionar=='1'){ ?>
          <td width="2%" align="center"><input type="checkbox" id="idcase" class="idcase" name="idcase[]" value="<?php echo $item['iddesignacion'] ?>" /></td>
        <?php } ?>

        <td width="5%"><?php echo $item['sedeabreviada'] ?></td>
        <td width="15%"><?php echo $item['carreraplan'] ?></td>
        <td width="13%"><?php echo $item['apellido'].", ".$item['nombre'] ?></td>
        <td width="13%"><?php echo $item['materia'] ?></td>
        <td width="9%"><?php echo $item['tipodesignacion'] ?></td>
        <td width="8%"><?php echo $item['categoria'] ?></td>
        <td width="9%"><?php echo $item['inicioformat'] ?></td>
        <td width="9%"><?php echo $item['finformat'] ?></td>
        <td width="5%"><?php echo $item['dedicacion'] ?></td>

        <?php if ($item['idresolucionprofesor']>=1){ ?>
          <td width="5%"><?php echo $item['resolucion'] ?></td>
        <?php } else { ?>
          <td align="center" bgcolor="#F2F5A9" width="5%"><?php echo ' - ' ?></td>
        <?php } ?>

      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>  