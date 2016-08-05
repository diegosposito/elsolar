<?php

require_once dirname(__FILE__).'/../lib/mesasexamenesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/mesasexamenesGeneratorHelper.class.php';

/**
 * mesasexamenes actions.
 *
 * @package    sig
 * @subpackage mesasexamenes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mesasexamenesActions extends autoMesasexamenesActions
{




 /* public function executeIndex(sfWebRequest $request)
  {

        $this->pager = new sfDoctrinePager('mesasexamenes', 100 );

	$filters= parent::getFilters();

       $this->pager->setQuery(Doctrine_Query::create()
                        ->from('mesasexamenes me')
			->innerJoin('examenes e on e.idmesaexamen=me.idmesaexamen')
			->where('e.idalumno = '.$this->getUser()->getAttribute('idalumno')));

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->filters = new MesasexamenesFormFilter();

        $this->sort = $this->getSort();

    }
*/

  public function executeIndex(sfWebRequest $request)
  {

        $this->pager = new sfDoctrinePager('mesasexamenes', 100 );
//$request->getParameter('idmesaexamen')
	$filters= parent::getFilters();
//
       $this->pager->setQuery(Doctrine_Query::create()
                        ->from('mesasexamenes')
			->where('idmesaexamen = '.$this->getUser()->getAttribute('idmesaexamen')));

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->filters = new MesasexamenesFormFilter();

        $this->sort = $this->getSort();

    }

}
