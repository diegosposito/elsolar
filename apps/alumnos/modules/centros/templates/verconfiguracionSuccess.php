  <style type="text/css">
    p { margin-left:5em; /* Or another measurement unit, like px */ }
  </style>
  <br>
<h1 align="center" style="color:black;">Configuraciones Generales</h1>

<!-- CONFIGURACIONES GENERALES -->
<table align="center" width="80%" cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="100%" align="center" class="hed">Configuraciones Generales del Sistema</td>
      </tr>
    </thead>
    <tbody>
      <tr class="fila_<?php echo 0 ; ?>">
        <td width="100%"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
          <a href="<?php echo url_for('centros/index') ?>">Modalidades ofrecidas por la Institución</a>
        </td>
      </tr>
      <tr class="fila_<?php echo 1 ; ?>">
        <td width="100%"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
          <a href="<?php echo url_for('listahorarios/index') ?>">Lista de horarios de Pacientes</a>
        </td>
      </tr>
      <tr class="fila_<?php echo 0 ; ?>">
        <td width="100%"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
          <a href="<?php echo url_for('listahorarios/index') ?>">Lista de horarios de Pacientes</a>
        </td>
      </tr>
      <br>
  
    </tbody>
  </table>

<!-- CONFIGURACIONES ARCHIVOS Y DOCUMENTOS ESTATICOS -->
  <table align="center" width="80%" cellspacing="0" class="stats">
    <thead>
      <tr>
        <td width="100%" align="center" class="hed">Configuración de Areas y Documentos</td>
      </tr>
    </thead>
    <tbody>
      <tr class="fila_<?php echo 0 ; ?>">
        <td width="100%"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
          <a href="<?php echo url_for('areadocumentos/index') ?>">Areas de Documentos</a>
        </td>
      </tr>
      <tr class="fila_<?php echo 1 ; ?>">
        <td width="100%"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/new.png' align='center' size='20' />
          <a href="<?php echo url_for('documentosinstitucion/index') ?>">Documentos por Area</a></td>
      </tr>
      <br>
    </tbody>
  </table>


 


