<?php

/**
 * categoriastitulos actions.
 *
 * @package    sig
 * @subpackage categoriastitulos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoriastitulosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->categorias_tituloss = Doctrine_Core::getTable('CategoriasTitulos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CategoriasTitulosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CategoriasTitulosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($categorias_titulos = Doctrine_Core::getTable('CategoriasTitulos')->find(array($request->getParameter('idcategoriatitulo'))), sprintf('Object categorias_titulos does not exist (%s).', $request->getParameter('idcategoriatitulo')));
    $this->form = new CategoriasTitulosForm($categorias_titulos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($categorias_titulos = Doctrine_Core::getTable('CategoriasTitulos')->find(array($request->getParameter('idcategoriatitulo'))), sprintf('Object categorias_titulos does not exist (%s).', $request->getParameter('idcategoriatitulo')));
    $this->form = new CategoriasTitulosForm($categorias_titulos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($categorias_titulos = Doctrine_Core::getTable('CategoriasTitulos')->find(array($request->getParameter('idcategoriatitulo'))), sprintf('Object categorias_titulos does not exist (%s).', $request->getParameter('idcategoriatitulo')));
    $categorias_titulos->delete();

    $this->redirect('categoriastitulos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $categorias_titulos = $form->save();

      $this->redirect('categoriastitulos/edit?idcategoriatitulo='.$categorias_titulos->getIdcategoriatitulo());
    }
  }
}
