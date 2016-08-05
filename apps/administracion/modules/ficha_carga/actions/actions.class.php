<?php

require_once dirname(__FILE__).'/../lib/ficha_cargaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ficha_cargaGeneratorHelper.class.php';

/**
 * ficha_carga actions.
 *
 * @package    sig
 * @subpackage ficha_carga
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ficha_cargaActions extends autoFicha_cargaActions
{









  public function executeIndex(sfWebRequest $request)
  {

        $this->pager = new sfDoctrinePager('ficha_carga', 100 );

	$filters= parent::getFilters();

       $this->pager->setQuery(Doctrine_Query::create()
                        ->from('fichacarga fa')
			->where('fa.idalumno = '.$this->getUser()->getAttribute('idalumno')));

        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->filters = new FichaCargaFormFilter();

        $this->sort = $this->getSort();

    }





  public function processForm(sfWebRequest $request, sfForm $form)
    {

	$fichacarga= new FichaCarga();
	$fichacarga->limpiar();

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
         
              if ($form->isValid())
                  {
                        $ficha = $form->save();

				$ficha->setIdalumno($this->getUser()->getAttribute('idalumno'));

				if( is_null($ficha->getFechavencimiento())) $ficha->setFechavencimiento($ficha->getFecha());

                                $ficha->save();
 			$this->forward('ficha_carga', 'index');
                  }
    }

/*
  public function executeLimpiar()
    {

		$fichacarga= new ficha_carga();

		$fichacarga->limpiar();

 		$this->forward('ficha_carga', 'index');

    }

*/



}
