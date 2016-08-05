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
        <td colspan="4" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda.</td>
      </tr>
      <tr>
        <td width="2%" align="center" class="hed"><input type="checkbox" id="selectall" /></td>
        <td width="5%" align="center" class="hed">Sede</td>
        <td width="13%" align="center" class="hed">Carrera-Plan</td>
        <td width="10%" align="center" class="hed">Facultad</td>
        <td width="13%" align="center" class="hed">Profesor</td>
        <td width="13%" align="center" class="hed">Materia</td>
        <td width="10%" align="center" class="hed">Tipo</td>
        <td width="12%" align="center" class="hed">Inicio</td>
        <td width="12%" align="center" class="hed">Fin</td>
        <td width="5%" align="center" class="hed">Dedicaci&oacuten</td>
        <td width="5%" align="center" class="hed">Estado</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <td align="center"><input type="checkbox" id="idcase" class="idcase" name="idcase[]" value="<?php echo $item['iddesignacion'] ?>" /></td>
        <td width="5%"><?php echo $item['sedeabv'] ?></td>
        <td width="13%"><?php echo $item['carreraplan'] ?></td>
        <td width="10%"><?php echo $item['facultad'] ?></td>
        <td width="13%"><?php echo $item['persona'] ?></td>
        <td width="13%"><?php echo $item['materia'] ?></td>
        <td width="10%"><?php echo $item['tipo'].'('.$item['categoria'].')' ?></td>
        <td width="12%"><?php echo $item['inicioformat'] ?></td>
        <td width="12%"><?php echo $item['finformat'] ?></td>
        <td width="5%"><?php echo $item['dedicacion'] ?></td>
       
        <?php switch ($item['idestadodesignacion']) {
            case 1: ?>
                <td bgcolor="#D8D8D8" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
            case 2: ?>
                <td bgcolor="#ACFA58" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
            case 3: ?>
                <td bgcolor="#F7FE2E" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
            case 4: ?>
                <td bgcolor="#848484" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;        
            case 5: ?>
                <td bgcolor="#088A08" width="5%"><?php echo $item['estadodesignacion'] ?></td>
                <?php
                break;
        }
        ?>
        <td width="6%" align="center"></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?> 