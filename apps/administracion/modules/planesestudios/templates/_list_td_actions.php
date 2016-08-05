<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_cargar">
      <?php 


//or ($sf_user->getGuardUser()->getIsSuperAdmin()
// if ($planesestudios->existePlanEnSede()==true)  

echo link_to(__('Cargar', array(), 'messages'), 'planesestudios/fichaalumnos?idplanestudio='.$planesestudios->getIdplanestudio(), 'idplanestudio=%%idplanestudio%%');

?>
    </li>


    <li class="sf_admin_action_cargar">
      <?php 


//or ($sf_user->getGuardUser()->getIsSuperAdmin()
// if ($planesestudios->existePlanEnSede()==true)  
echo link_to(__('Confirmar', array(), 'messages'), 'planesestudios/Confirmar?idplanestudio='.$planesestudios->getIdplanestudio(), 'idplanestudio=%%idplanestudio%%');

?>
    </li>

    <li class="sf_admin_action_cargar">
      <?php 
/*
if ($sf_user->getGuardUser()->getIsSuperAdmin()) echo link_to(__('CRR', array(), 'messages'), 'planesestudios/crr?idplanestudio='.$planesestudios->getIdplanestudio(), 'idplanestudio=%%idplanestudio%%');
*/
?>
    </li>
    <li class="sf_admin_action_cargar">
      <?php 
/*
if ($sf_user->getGuardUser()->getIsSuperAdmin()) echo link_to(__('CRSF', array(), 'messages'), 'planesestudios/crsf?idplanestudio='.$planesestudios->getIdplanestudio(), 'idplanestudio=%%idplanestudio%%');
*/
?>
    </li>

    <li class="sf_admin_action_cargar">
      <?php 

if ($sf_user->getGuardUser()->getIsSuperAdmin()) echo link_to(__('Examenes', array(), 'messages'), 'planesestudios/examenes?idplanestudio='.$planesestudios->getIdplanestudio(), 'idplanestudio=%%idplanestudio%%');

?>
    </li>


    </li>

    <li class="sf_admin_action_cargar">
      <?php 

if ($sf_user->getGuardUser()->getIsSuperAdmin()) echo link_to(__('alumat', array(), 'messages'), 'planesestudios/alumat?idplanestudio='.$planesestudios->getIdplanestudio(), 'idplanestudio=%%idplanestudio%%');

?>
    </li>

    <li class="sf_admin_action_convenio">
      <?php 

if ($sf_user->getGuardUser()->getIsSuperAdmin() && $planesestudios->getIdplanestudio()==101) echo link_to(__('convenio', array(), 'messages'), 'planesestudios/convenio?idplanestudio='.$planesestudios->getIdplanestudio(), 'idplanestudio=%%idplanestudio%%');

?>
    </li>
  </ul>
</td>
