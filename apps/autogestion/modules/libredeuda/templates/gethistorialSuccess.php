<script type="text/javascript">

$(function() {
		$('#dataTable').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sDom": '<"H"lfr>t<"F"ip>',
			"aoColumns": [
				{ "sWidth": "5%", "sClass": "center" },
				{ "sWidth": "30%" },
				{ "sWidth": "15%" },
				{ "sWidth": "10%" },
				{ "sWidth": "10%" },
				{ "sWidth": "15%" },
				{ "sWidth": "10%", "bSortable": false }
			], 	
			"oLanguage": {
				"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"sLengthMenu": "Mostrando _MENU_ registros por página",
				"sZeroRecords": "Sin resultados",
				"sEmptyTable": "Sin datos disponibles en la tabla",
				"sInfoEmpty": "Sin resultados",
				"sSearch": "Buscar:",
				"oPaginate": {
					"sFirst": "<<",
					"sLast": ">>",
					"sNext": ">",
					"sPrevious": "<"
				}
			}    			
		});   		
});
</script>
<br />

<h1>Historial de libre deuda</h1>
<br />	 
  <table width="40%" id="dataTable" class="display dataTable" cellspacing="0">
  <thead>
    <tr>
      <th class="hed">Id</th>
      <th class="hed">Nombre</th>
      <th class="hed">Nro. documento</th>
      <th class="hed">Tipo</th>
      <th class="hed">Estado</th>
      <th class="hed">Libre deuda</th>
      <th class="hed">Observaciones</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     foreach($historial as $inscripcion){ 
  ?>
   	  <tr>
      <td><?php echo $inscripcion['idalumno'] ?></td>
      <td><?php echo $inscripcion['alumno'] ?></td>
      <td><?php echo $inscripcion['dni'] ?></td>
      <td><?php echo $inscripcion['tipo'] ?></td>
      <td><?php echo $inscripcion['estado'] ?></td>
      <td><?php echo $inscripcion['fechalibredeuda'] ?></td>
      <td><?php echo $inscripcion['observaciones'] ?></td>
      </tr> 
  <?php } ?>
  </tbody>
 </table>