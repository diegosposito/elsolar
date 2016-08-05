<script>

$(document).ready(function(){
 
    $('#botonlista').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('profesores/obtenerlistasabana'); ?>",
          {idsede: $('#idsede').val(),idanio: $('#idanio').val()},
        function(data){
            $('#idresultados').html(data);
        }
        );
    }); 

});    

</script>

<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="left"><p style="color:green"><b> <?php echo $msgSuccess ?> </b></p></div>


</br>
<h3 align="center">Consultar Observaciones por Sede/Facultad </h3>
<form action="<?php echo url_for('profesores/consultarobservaciones') ?>" method="post" id="formLista">
  <table align="center" cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
      <td align="center" colspan="2"></td>
      <td align="left" colspan="4"><b>Sede: </b>
      <select id="idsede" name="idsede">
      <?php foreach ($sedes as $sede) { ?>
        <option value="<?php echo $sede['idsede'] ?>" <?php if ($sede['idsede'] == $idsede) { ?>selected<?php } ?>><?php echo $sede['nombre'] ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
      <tr>
      <td align="center" colspan="2"></td>
      <td align="left" colspan="4"><b>Facultad: </b>
      <select id="idfacultad" name="idfacultad">
      <?php foreach ($facultades as $facultad) { ?>
        <option value="<?php echo $facultad['idfacultad'] ?>" <?php if ($facultad['idfacultad'] == $idfacultad) { ?>selected<?php } ?>><?php echo $facultad['nombre'] ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
      <tr>
      <td align="center" colspan="2"></td>
      <td align="left" colspan="4"><b>Período     : </b>
      <select id="idanio" name="idanio">
      <?php for ($anio = date("Y"); $anio > date("Y")-10; $anio=$anio-1) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $anioseleccionado) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
      <tr>
       <td align="center" colspan="4">
          <input type="submit" value="Mostrar Información" id="botonprint" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
</div><br>

<?php if (count($resultado) > 0){ ?> 
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="4" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda.</td>
      </tr>
      <tr>
        <td width="15%" align="center" class="hed">Sede</td>
        <td width="15%" align="center" class="hed">Facultad</td>
        <td width="30%" align="center" class="hed">Estado</td>
        <td width="30%" align="center" class="hed">Observaciones</td>
        <td width="10%" align="center" class="hed">Fecha</td>
      </tr>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <td width="15%"><?php echo $item['sede'] ?></td>
        <td width="15%"><?php echo $item['facultad'] ?></td>
        <td width="30%"><?php echo $item['estado'] ?></td>
        <td width="30%"><?php echo $item['observaciones'] ?></td>
        <td width="10%"><?php echo $item['fecha'] ?></td>
      </tr>
<?php } ?>
</table>
<?php } ?>