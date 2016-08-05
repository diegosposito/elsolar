<h1>Comparativa de Promedios</h1>
<script>
	$(function() {
		$( "#fecha-desde1" ).datepicker({ 
			dateFormat: 'dd-mm-yy', 
			showOn: "button",
			buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
			buttonImageOnly: true,
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],				
		});
		$( "#fecha-hasta1" ).datepicker({ 
			dateFormat: 'dd-mm-yy', 
			showOn: "button",
			buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
			buttonImageOnly: true,
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],				
		});
		$( "#fecha-desde2" ).datepicker({ 
			dateFormat: 'dd-mm-yy', 
			showOn: "button",
			buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
			buttonImageOnly: true,
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],				
		});
		$( "#fecha-hasta2" ).datepicker({ 
			dateFormat: 'dd-mm-yy', 
			showOn: "button",
			buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
			buttonImageOnly: true,
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],				
		});						
	});

	$(function() {
		$( "input:submit, a, button", ".demo" ).button();  
	});
</script>
<p><b>Seleccionar 2 per&iacute;odos a comparar</b></p>

<form method="post" action="<?php echo url_for('estadisticas/promediosxcarrera' ) ?>" method="post">
<div class="demo" align="center">
  <table cellspacing="0" class="stats" width="50%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
			<input value="Generar resultados" type="submit">
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="50%">Desde: <input id="fecha-desde1" name="fecha-desde1" type="text" size="10"></td>
        <td>Hasta: <input id="fecha-hasta1" name="fecha-hasta1" type="text" size="10"></td>
      </tr>    	
      <tr>
        <td>Desde: <input id="fecha-desde2" name="fecha-desde2" type="text" size="10"></td>
        <td>Hasta: <input id="fecha-hasta2" name="fecha-hasta2" type="text" size="10"></td>
      </tr>  
      <tr>
        <td colspan="2">Carrera:
			<select name="idcarrera" id="idcarrera"> 
			    <?php if (count($carreras) > 0){
			      //echo "<option value='0' selected='selected' >----SELECCIONAR----</option>";
			      foreach ($carreras as $k => $v){
			        echo "<option value=".$k.">".$v."</option>";
			      }
			    } ?> 
			</select>          
        </td>
      </tr> 
      <tr>
        <td>Ausentes: <input type="checkbox" name="ausentes" value="Ausentes"></td>
        <td>Desaprobados: <input type="checkbox" name="desaprobados" value="Desaprobados"></td>
      </tr>        
               
    </tbody>
  </table> 
</div>  
</form>
<br>
<?php if(isset($resultado)){ ?>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td colspan="2" class="hed" align="center" width="1%"></th>
      <td class="hed" width="15%"><?php echo $primerperiodo ?></th>
      <td class="hed" width="15%"><?php echo $segundoperiodo ?></th>
    </tr>
    <tr>
      <td class="hed" align="center" width="1%"></th>
      <td class="hed" align="center" >Materia</th>
      <td class="hed" align="center" >Promedio</th>
      <td class="hed" align="center" >Promedio</th>      
    </tr>
    <?php foreach ($resultado as $data): ?>
    <tr>
      <td align="center"><?php echo $data['curso']; ?></td>
      <td><?php echo $data['nombre']; ?></td>
      <td align="center"><?php echo $data['promedioprimerperiodo']; ?></td>
      <td align="center"><?php echo $data['promediosegundoperiodo']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php } ?>