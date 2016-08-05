<?php

require_once dirname(__FILE__).'/../lib/planesestudiosGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/planesestudiosGeneratorHelper.class.php';

/**
 * planesestudios actions.
 *
 * @package    sig
 * @subpackage planesestudios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planesestudiosActions extends autoPlanesestudiosActions
{

  public function executeIndex(sfWebRequest $request)
  {

        $this->pager = new sfDoctrinePager('planesestudios', 100 );

	$filters= parent::getFilters();

        $persona= new personas();
        $arrPlanes=$persona->getPlanesinscripto($this->getUser()->getAttribute('idpersona'));
	$arreglo='';
	$contador=0;
	foreach($arrPlanes as $ap) {
	if($contador==0) {$arreglo=$ap;} else { $arreglo=$arreglo.','.$ap; };
	$contador++;
	}


       $this->pager->setQuery(Doctrine_Query::create()
                        ->from('planesestudios ex')
			->where('ex.idplanestudio IN ('.$arreglo.')'));

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->filters = new PlanesestudiosFormFilter();

        $this->sort = $this->getSort();

    }




  public function executeFichaalumnos(sfWebRequest $request)
  {

	if ($this->getUser()->isAuthenticated()) { 
		$oUsuario = $this->getUser()->getGuardUser();
		$oPerfil = $oUsuario->getProfile();

		$this->getUser()->setAttribute('idplanestudio',$request->getParameter('idplanestudio'));
		$alumno= new alumnos();

		$idalumno=$alumno->obtenerAlumnoPersonaPlan($this->getUser()->getAttribute('idpersona'), $this->getUser()->getAttribute('idplanestudio'));

		$this->getUser()->setAttribute('idalumno',$idalumno);

		$this->redirect('ficha_carga');
	}


  }



  public function executeConfirmar(sfWebRequest $request)
  {

	if ($this->getUser()->isAuthenticated()) { 
		$oUsuario = $this->getUser()->getGuardUser();
		$oPerfil = $oUsuario->getProfile();

		$this->getUser()->setAttribute('idplanestudio',$request->getParameter('idplanestudio'));
		$alumno= new alumnos();

		$idalumno=$alumno->obtenerAlumnoPersonaPlan($this->getUser()->getAttribute('idpersona'), $this->getUser()->getAttribute('idplanestudio'));

		$this->getUser()->setAttribute('idalumno',$idalumno);

		$fichacarga= new fichacarga();

		$fichacarga->confirmar($idalumno);

		$idsede = $this->getUser()->getProfile()->getIdsede();

		if ($idsede==1) { 
			exec("/home/importar/transferir_sc");
			$this->redirect('ficha_carga');
		}
		if ($idsede==2) { 
			exec("/home/importar/transferir_crg");
			$this->redirect('ficha_carga');
		}
		if ($idsede==3) { 
			exec("/home/importar/transferir_uav");
			$this->redirect('ficha_carga');
		}

		if ($idsede==4) { 
			exec("/home/importar/transferir_crr");
			$this->redirect('ficha_carga');
		}
		if ($idsede==5) { 
			exec("/home/importar/transferir_crsf");
			$this->redirect('ficha_carga');
		}

		if ($idsede==6) { 
			exec("/home/importar/transferir_crp");
			$this->redirect('ficha_carga');
		}

		if ($idsede==8) { 
			exec("/home/importar/transferir_vt");
			$this->redirect('ficha_carga');
			
		}

		$this->redirect('ficha_carga');
	}


  }



  public function executeCrr(sfWebRequest $request)
  {
	$oUsuario = $this->getUser()->getGuardUser();
	if ($oUsuario->getIsSuperAdmin()) { 
 		exec("/usr/bin/php /home/importar/examenes_crr.php");
 		exec("/usr/bin/php /home/importar/eq_crr.php");
		$this->redirect('ficha_carga');
	}


  }

  public function executeCrsf(sfWebRequest $request)
  {
	$oUsuario = $this->getUser()->getGuardUser();
	if ($oUsuario->getIsSuperAdmin()) { 
 		exec("/usr/bin/php /home/importar/examenes_crsf.php");
 		exec("/usr/bin/php /home/importar/eq_crsf.php");
		$this->redirect('ficha_carga');
	}


  }




  public function executeExamenes(sfWebRequest $request)
  {

	if ($this->getUser()->isAuthenticated()) { 
		$oUsuario = $this->getUser()->getGuardUser();
		$oPerfil = $oUsuario->getProfile();

		$this->getUser()->setAttribute('idplanestudio',$request->getParameter('idplanestudio'));
		$alumno= new alumnos();

		$idalumno=$alumno->obtenerAlumnoPersonaPlan($this->getUser()->getAttribute('idpersona'), $this->getUser()->getAttribute('idplanestudio'));

		$this->getUser()->setAttribute('idalumno',$idalumno);

		$fichacarga= new fichacarga();

		$fichacarga->confirmar($idalumno);

		$idsede = $this->getUser()->getProfile()->getIdsede();



		$this->redirect('examenes');
	}


  }

  public function executeMesasexamenes(sfWebRequest $request)
  {

	if ($this->getUser()->isAuthenticated()) { 
		$oUsuario = $this->getUser()->getGuardUser();
		$oPerfil = $oUsuario->getProfile();

		$this->getUser()->setAttribute('idplanestudio',$request->getParameter('idplanestudio'));
		$alumno= new alumnos();

		$idalumno=$alumno->obtenerAlumnoPersonaPlan($this->getUser()->getAttribute('idpersona'), $this->getUser()->getAttribute('idplanestudio'));

		$this->getUser()->setAttribute('idalumno',$idalumno);

		$fichacarga= new fichacarga();

		$fichacarga->confirmar($idalumno);

		$idsede = $this->getUser()->getProfile()->getIdsede();



		$this->redirect('mesasexamenes');
	}


  }

  public function executeAlumat(sfWebRequest $request)
  {

	if ($this->getUser()->isAuthenticated()) { 

		$this->getUser()->setAttribute('idplanestudio',$request->getParameter('idplanestudio'));

		$alumno= new alumnos();

		$idalumno=$alumno->obtenerAlumnoPersonaPlan($this->getUser()->getAttribute('idpersona'), $this->getUser()->getAttribute('idplanestudio'));

		$this->getUser()->setAttribute('idalumno',$idalumno);



		$this->redirect('alumat');
	}


  }


  public function executeConvenio(sfWebRequest $request)
  {

	if ($this->getUser()->isAuthenticated()) { 

		$this->getUser()->setAttribute('idplanestudio',$request->getParameter('idplanestudio'));

		$alumno= new alumnos();

		$idalumno=$alumno->obtenerAlumnoPersonaPlan($this->getUser()->getAttribute('idpersona'), $this->getUser()->getAttribute('idplanestudio'));

		$this->getUser()->setAttribute('idalumno',$idalumno);

		$alumno->completarMateriasConvenioIes();

		$this->redirect('ficha_carga');
	}


  }




}
