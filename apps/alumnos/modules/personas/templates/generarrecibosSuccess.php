<script>

$(document).ready(function(){
 
    $('#botonlista').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('personas/obtenerrecibosgenerados'); ?>",
          { permite_seleccionar: '1'},
        function(data){
            $('#idresultados').html(data);
        }
        );
    }); 

});    

</script>
<br>
<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="left"><p style="color:green"><b> <?php echo $msgSuccess ?> </b></p></div>


</br>
<h3 align="center">Generar recibos del mes actual </h3>
<h4>Observaciones: </h4>
<h5>Se pueden desmarcar registros que se considere no deberían generarse para este mes, por el motivo que corresponda. </h5>

<form action="<?php echo url_for('personas/grabarrecibosgenerados') ?>" method="post" id="formLista">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input type="button" value="Mostrar recibos a generar" name="botonlista" id="botonlista" />
        </td>
        <td colspan="2" align="center">
          <input type="submit" value="Generar recibos seleccionados" id="botonasignar" />
        </td>
      </tr>
    </tfoot>
  </table>
  <br>
  <div id="idresultados" name="resultados" align="center"></div>
</form>
</div><br>

