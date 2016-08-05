<?php

/**
 * materiasgenericas actions.
 *
 * @package    sig
 * @subpackage materiasgenericas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materiasgenericasActions extends sfActions
{
	
  public function executeEliminar(sfWebRequest $request)
  {
    $oMateria = Doctrine_Core::getTable('MateriasGenericas')->find($request->getParameter('idmateria'));
	$idmateriaplan = $oMateria->getIdmateriaplan();
    $oMateria->delete(); 
	
  	echo json_encode($idmateriaplan);
	
  	return sfView::NONE;
  }
  

  public function executeAgregar(sfWebRequest $request)
  { 
    $arrMateriaGenerica = $request->getParameter('materias_genericas');

	$oMateriaGenerica = new MateriasGenericas();
	$oMateriaGenerica->setIdmateriaplangenerica($arrMateriaGenerica['idmateriaplangenerica']);
	$oMateriaGenerica->setIdmateriaplan($arrMateriaGenerica['idmateriaplan']);
	$oMateriaGenerica->setValormateria($arrMateriaGenerica['valormateria']);
	$oMateriaGenerica->save();
		
	return sfView::NONE;    
  }  
  	
  public function executeIndex(sfWebRequest $request)
  {
    $this->materias_genericass = Doctrine_Core::getTable('MateriasGenericas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MateriasGenericasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MateriasGenericasForm();

    $this->processForm($request, $this->form);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($materias_genericas = Doctrine_Core::getTable('MateriasGenericas')->find(array($request->getParameter('id'))), sprintf('Object materias_genericas does not exist (%s).', $request->getParameter('id')));
    $this->form = new MateriasGenericasForm($materias_genericas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($materias_genericas = Doctrine_Core::getTable('MateriasGenericas')->find(array($request->getParameter('id'))), sprintf('Object materias_genericas does not exist (%s).', $request->getParameter('id')));
    $this->form = new MateriasGenericasForm($materias_genericas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($materias_genericas = Doctrine_Core::getTable('MateriasGenericas')->find(array($request->getParameter('id'))), sprintf('Object materias_genericas does not exist (%s).', $request->getParameter('id')));
    $materias_genericas->delete();

    $this->redirect('materiasgenericas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $materias_genericas = $form->save();

      $this->redirect('materiasplanes/edit?idmateriaplan='.$materias_genericas->getIdmateriaplangenerica());
    }
  }
}
