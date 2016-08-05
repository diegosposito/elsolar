<?php

require_once dirname(__FILE__).'/../lib/alumatGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/alumatGeneratorHelper.class.php';

/**
 * alumat actions.
 *
 * @package    sig
 * @subpackage alumat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alumatActions extends autoAlumatActions
{



  public function executeIndex(sfWebRequest $request)
  {

        $this->pager = new sfDoctrinePager('alumat', 100 );

	$filters= parent::getFilters();

       $this->pager->setQuery(Doctrine_Query::create()
                        ->from('alumat am')
			->where('am.idalumno = '.$this->getUser()->getAttribute('idalumno')));

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->filters = new AluMatFormFilter();

        $this->sort = $this->getSort();

    }

}
