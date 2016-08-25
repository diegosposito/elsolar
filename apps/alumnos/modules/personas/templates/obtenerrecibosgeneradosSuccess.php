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
        <td colspan="4" width="100%"><b>Se van a generar <?php echo count($resultado); ?> nuevos recibos a cobrar.</b></td>
      </tr>
      <tr>
        <?php if ($permite_seleccionar=='1'){ ?>
          <td width="2%" align="center" class="hed"><input type="checkbox" id="selectall" /></td>
        <?php } ?>

        <td width="40%" align="center" class="hed">Socio</td>
        <td width="20%" align="center" class="hed">Mes</td>
        <td width="20%" align="center" class="hed">Monto</td>
    </tr>
    </thead>
    <tbody>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <?php if ($permite_seleccionar=='1'){ ?>
          <td width="2%" align="center"><input type="checkbox" id="idcase" class="idcase" name="idcase[]" value="<?php echo $item['idpersona'] ?>" /></td>
        <?php } ?>

        <td width="40%"><?php echo $item['apellido'].", ".$item['nombre'] ?></td>
        <td width="20%"><?php echo $item['mes'] ?></td>
        <td width="20%"><?php echo '$'.$item['monto'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>  