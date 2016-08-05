<script>

$(document).ready(function(){
 
    $('#botonlista').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('profesores/obtenerlistasabana'); ?>",
          {idsede: $('#idsede').val(),idanio: $('#idanio').val(), permite_seleccionar: '1'},
        function(data){
            $('#idresultados').html(data);
        }
        );
    }); 

    $.post("<?php echo url_for('designaciones/obtenerresolucionessede'); ?>",
      { idsede: '1' },
      function(data){
        $('#idresolucion').html(data);
      }
    );

    $('#idsede').change(function(){
          
          if($('#idsede').val()!=0){
              // cargar las resoluciones asociadas a una sede seleccionada
              $.post("<?php echo url_for('designaciones/obtenerresolucionessede'); ?>",
                { idsede: $('#idsede').val() },
                function(data){
                    $('#idresolucion').html(data);
                  }
              );
          }
        });

});    

</script>
<br>
<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="left"><p style="color:green"><b> <?php echo $msgSuccess ?> </b></p></div>


</br>
<h3 align="center">Asignar Resolución de Facultad a Designaciones Visadas </h3>
<h4>Observaciones: </h4>
<h5>Se pueden seleccionar designaciones con o sin número de Resolución. 
Si una designación visada ya tiene número de Resolución, esta será reemplazada por la nueva resolución elegida. </h5>

<form action="<?php echo url_for('profesores/asignarresolucionseleccionada') ?>" method="post" id="formLista">
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
      <td align="center" colspan="4"><b>Resoluciones     : </b>
      <select id="idresolucion" name="idresolucion"></select>        
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
        <td colspan="2" align="center">
          <input type="button" value="Mostrar informacion" name="botonlista" id="botonlista" />
        </td>
        <td colspan="2" align="center">
          <input type="submit" value="Asignar Resolución Seleccionada" id="botonasignar" />
        </td>
      </tr>
    </tfoot>
  </table>
  <br>
  <div id="idresultados" name="resultados" align="center"></div>
</form>
</div><br>

