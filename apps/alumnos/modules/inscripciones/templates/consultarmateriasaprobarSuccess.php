<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td class="hed">Alumno: <?php echo $alumno->getPersonas(); ?></td>
 
  </tr>    
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"></div></td>
  </tr>

  <tr>
    <td colspan="2" class="hed">Control para Mesas Regulares:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="10%">Apro.Sis.</td>
		      <td class="hed" align="center" width="10%">Apro.Alu.</td>
		      <td class="hed" align="center" width="10%">Reg.Sis.</td>
		      <td class="hed" align="center" width="10%">Reg.Alu.</td>
		      <td class="hed" align="center" width="10%">Idmp</td>
		    </tr>
		  </thead>
		  <tbody> 
		<?php foreach($detalle_materias as $detalle){ ?>
		    <tr <?php if($detalle['total_correlativas_regular']!=$detalle['total_correlativas_materia_regular']) echo "bgcolor='#FDB60F'"; ?>>
		      <td align="center" class="item"><?php //echo $detalle[0]; ?></td>
		      <td class=""><?php echo $detalle['materia']; ?></td>
		      <td align="center"><?php echo $detalle['total_correlativas_materia_aprobar']; ?> </td>
		      <td align="center"><?php echo $detalle['total_correlativas_materia_aprobado']; ?></td>
		      <td align="center"><?php echo $detalle['total_correlativas_regular']; ?> </td>
		      <td align="center"><?php echo $detalle['total_correlativas_materia_regular']; ?></td>
		      <td align="center">	      
			<?php //echo $detalle['total_correlativas_materia_regular']; ?>
        			
		      </td>
		    </tr>
			<?php }; ?>
		  </tbody>
		</table>
    </td>
  </tr> 


	    
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>
