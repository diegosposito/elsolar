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
<h3 align="center">Generar Memoria Anual </h3>
<form action="<?php echo url_for('estadisticas/memoria') ?>" method="post" id="formLista">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
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
        <td colspan="2" align="center">
          <input type="submit" value="Generar memoria" id="botonprint" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
</div><br>

<div id="idresultados" name="resultados" align="center"></div>