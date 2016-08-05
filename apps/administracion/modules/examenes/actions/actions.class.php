<?php

require_once dirname(__FILE__).'/../lib/examenesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/examenesGeneratorHelper.class.php';

/**
 * examenes actions.
 *
 * @package    sig
 * @subpackage examenes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class examenesActions extends autoExamenesActions
{



  public function executeIndex(sfWebRequest $request)
  {

        $this->pager = new sfDoctrinePager('examenes', 100 );

	$filters= parent::getFilters();

       $this->pager->setQuery(Doctrine_Query::create()
                        ->from('examenes e')
			->where('e.idalumno = '.$this->getUser()->getAttribute('idalumno')));

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->filters = new ExamenesFormFilter();

        $this->sort = $this->getSort();

    }



  public function executeMesasexamenes(sfWebRequest $request)
  {

	//if ($this->getUser()->isAuthenticated()) { 

		$idexamen=$request->getParameter('idexamen'); 
		$oExamenes = Doctrine::getTable('Examenes')->find($idexamen);

		$idmesaexamen = $oExamenes->getIdmesaexamen();
		
		$this->getUser()->setAttribute('idmesaexamen',$idmesaexamen);
		$this->redirect('mesasexamenes');
	//}


  }

}
