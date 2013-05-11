<?php

/**
 * var_config actions.
 *
 * @package    lufy
 * @subpackage var_config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class var_configActions extends BackendActions
{

    public function executeIndex(sfWebRequest $request) {
        $this->var_configs = Doctrine::getTable('varConfig')
                        ->createQuery('a')
                        ->execute();
    }

    

    public function executeNew(sfWebRequest $request) {
        $this->form = new varConfigForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new varConfigForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($var_config = Doctrine::getTable('varConfig')->find(array($request->getParameter('id_var'))), sprintf('Object var_config does not exist (%s).', $request->getParameter('id_var')));
        $this->form = new varConfigForm($var_config);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($var_config = Doctrine::getTable('varConfig')->find(array($request->getParameter('id_var'))), sprintf('Object var_config does not exist (%s).', $request->getParameter('id_var')));
        $this->form = new varConfigForm($var_config);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($var_config = Doctrine::getTable('varConfig')->find(array($request->getParameter('id_var'))), sprintf('Object var_config does not exist (%s).', $request->getParameter('id_var')));
        $var_config->delete();

        $this->redirect('var_config/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $var_config = $form->save();

            $this->redirect('var_config/index');
        }
    }

}
