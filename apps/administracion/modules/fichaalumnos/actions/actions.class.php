<?php

require_once dirname(__FILE__).'/../lib/fichaalumnosGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/fichaalumnosGeneratorHelper.class.php';

/**
 * fichaalumnos actions.
 *
 * @package    sig
 * @subpackage fichaalumnos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fichaalumnosActions extends autoFichaalumnosActions
{




  public function executeIndex(sfWebRequest $request)
  {

        $this->pager = new sfDoctrinePager('fichaalumnos', 100 );

	$filters= parent::getFilters();

       $this->pager->setQuery(Doctrine_Query::create()
                        ->from('fichaalumnos fa')
			->where('fa.idalumno = '.$this->getUser()->getAttribute('idalumno')));

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->filters = new FichaalumnosFormFilter();

        $this->sort = $this->getSort();

    }





  protected function processForm(sfWebRequest $request, sfForm $form)
    {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
         
              if ($form->isValid())
                  {
                        $ficha = $form->save();

				$ficha->setIdalumno($this->getUser()->getAttribute('idalumno'));

				if( is_null($ficha->getFechavencimiento())) $ficha->setFechavencimiento($ficha->getFecha());

                                $ficha->save();
 			$this->forward('fichaalumnos', 'index');
                  }
    }
}
