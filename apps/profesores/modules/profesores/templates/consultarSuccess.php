<?php if (count($resultado) > 0){ ?>              
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="4" width="100%">Se han encontrado <?php echo count($resultado); ?> coincidencias de la búsqueda.</td>
      </tr>
      <tr>
        <td width="10%" align="center" class="hed">Sede</td>
        <td width="15%" align="center" class="hed">Carrera-Plan</td>
        <td width="10%" align="center" class="hed">Profesor</td>
        <td width="15%" align="center" class="hed">Materia</td>
        <td width="10%" align="center" class="hed">Cargo docente</td>
        <td width="9%" align="center" class="hed">Inicio</td>
        <td width="9%" align="center" class="hed">Fin</td>
        <td width="5%" align="center" class="hed">Dedicaci&oacuten</td>
        <td width="5%" align="center" class="hed">Estado</td>

        <?php if ($item['idestadodesignacion']==1 || $item['idestadodesignacion']==3 ){ 
               if ($idsede<>1 && $item['visibleensede']==0 ){ ?>
                  <td width="6%" align="center" class="hed"></td>
                  <td width="6%" align="center" class="hed"></td>
                <?php } 
               if ($idsede==1 && $item['idsede']==1 ){ ?>
                  <td width="6%" align="center" class="hed"></td>
                  <td width="6%" align="center" class="hed"></td>
               <?php } 
               if ($idsede==1 && $item['idsede']<>1 && $item['visibleensede']==1){ ?>
                  <td width="6%" align="center" class="hed"></td>
               <?php } ?>
        <?php } ?>

        <?php if ($item['idestadodesignacion']==1 || $item['idestadodesignacion']==3 ){ 
           if ($item['idsede'] == $idsede ){ ?>
              <td width="6%" align="center" class="hed"></td>
           <?php } ?>
           <td width="6%" align="center" class="hed"></td>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <td width="10%"><?php echo $item['sedeabv'] ?></td>
        <td width="15%"><?php echo $item['carreraplan'] ?></td>
        <td width="10%"><?php echo $item['persona'] ?></td>
        <td width="15%"><?php echo $item['materia'] ?></td>
        <td width="10%"><?php echo $item['tipo'].' ('.$item['categoria'].')' ?></td>
        <td width="9%"><?php echo $item['inicioformat'] ?></td>
        <td width="9%"><?php echo $item['finformat'] ?></td>
        <td width="5%"><?php echo $item['dedicacion'] ?></td>

        <?php switch ($item['idestadodesignacion']) {
            case 1: ?>
                <td bgcolor="#D8D8D8" width="5%"><?php echo $item['estadodesignacion'].($item['idsede']>1 && $item['visibleensede']==1 ? ' ( fin de carga)':'') ?></td>
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
        <?php 
        // Solo se puede Editar/Eliminar si el estado de la designacion es 1 o 3, 
        if ($item['idestadodesignacion']==1 || $item['idestadodesignacion']==3 ){ 
           if ($idsede<>1 && $item['visibleensede']==0 ){ ?>
              <td width="6%" align="center"><?php echo button_to("Editar", 'profesores/edit?iddesignacion='.$item['iddesignacion'],'class="mhead"'); ?></td>
              <td width="6%" align="center"><?php echo button_to("Eliminar", 'designaciones/deleteconfirmar?iddesignacion='.$item['iddesignacion'],'class="mhead"'); ?></td>
           <?php } 
           if ($idsede==1 && $item['idsede']==1 ){ ?>
              <td width="6%" align="center"><?php echo button_to("Editar", 'profesores/edit?iddesignacion='.$item['iddesignacion'],'class="mhead"'); ?></td>
              <td width="6%" align="center"><?php echo button_to("Eliminar", 'designaciones/deleteconfirmar?iddesignacion='.$item['iddesignacion'],'class="mhead"'); ?></td>
           <?php } 
           if ($idsede==1 && $item['idsede']<>1 && $item['visibleensede']==1){ ?>
              <td width="6%" align="center"><?php echo button_to("Eliminar", 'designaciones/deleteconfirmar?iddesignacion='.$item['iddesignacion'],'class="mhead"'); ?></td>
           <?php } ?>
        <?php } ?>
      
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?> 