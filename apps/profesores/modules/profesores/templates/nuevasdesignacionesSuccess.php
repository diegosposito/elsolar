<script>

$(document).ready(function(){
 
    $('#botonlista').click(function() {
        $.post("<?php echo url_for('profesores/obtenernuevasdesignaciones'); ?>",
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
<h3 align="center">Listado de Nuevas Designaciones </h3>
<p align="center">El análisis se hace con respecto al año anterior al seleccionado</p>
<form action="<?php echo url_for('profesores/imprimirnuevasdesignaciones') ?>" method="post" id="formLista">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
      <td align="center" colspan="4"><b>Sede: </b>
      <select id="idsede" name="idsede">
      <?php foreach ($sedes as $sede) { ?>
        <option value="<?php echo $sede['idsede'] ?>" <?php if ($sede['idsede'] == $idsede) { ?>selected<?php } ?>><?php echo $sede['nombre'] ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
      <tr>
      <td align="center" colspan="4"><b>Período     : </b>
      <select id="idanio" name="idanio">
      <?php for ($anio = date("Y"); $anio > date("Y")-10; $anio=$anio-1) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $anioseleccionado) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
       <tr>
      <td align="center" colspan="4"><b>Formato     : </b>
      <select id="idformato" name="idformato">
        <option value="1">PDF</option>
        <option value="2">CSV</option>
      </select>        
      </td>
      </tr>    
      <tr>
        <td colspan="2" align="center">
          <input type="button" value="Mostrar informacion" name="botonlista" id="botonlista" />
        </td>
        <td colspan="2" align="center">
          <input type="submit" value="Imprimir lista" id="botonprint" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
</div><br>

<div id="idresultados" name="resultados" align="center"></div>