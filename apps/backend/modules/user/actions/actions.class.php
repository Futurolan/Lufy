<?php

/**
 * user actions.
 *
 * @package    lufy
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->users = Doctrine::getTable('teamPlayer')
                        ->createQuery('a')
                        ->where('is_player = 1')
                        ->execute();
    }

    public function executeExportCsv(sfWebRequest $request) {
        header("Content-type: application/excel");
        header('Content-disposition: attachement; filename="test.xlsx"');
        $users = Doctrine::getTable('teamPlayer')
                        ->createQuery('a')
                        ->execute();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Futurolan");
        $objPHPExcel->getProperties()->setLastModifiedBy("Futurolan");
        $objPHPExcel->getProperties()->setTitle("Liste des joueurs");

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Liste des joueurs');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Cree le ' . date('d/m/y'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Nom');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Prenom');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Pseudo');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Licence Masters');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Licence GA');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Adresse');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'C P');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Ville');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Pays');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Telephone');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Birthdate');
        $i = 5;
        foreach ($users as $user) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $i, $user->getSfGuardUser()->getId());
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $i, $user->getSfGuardUser()->getLastName());
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $i, $user->getSfGuardUser()->getFirstName());
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $i, $user->getSfGuardUser()->getUsername());
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $i, $user->getSfGuardUser()->getEmailAddress());
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $i, $user->getSfGuardUser()->getLicenceMasters());
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $i, $user->getSfGuardUser()->getLicenceGa());
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $i, $user->getSfGuardUser()->getAddress());
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $i, $user->getSfGuardUser()->getZipcode());
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $i, $user->getSfGuardUser()->getCity());
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $i, $user->getSfGuardUser()->getCountry());
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $i, $user->getSfGuardUser()->getPhone());
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $i, $user->getSfGuardUser()->getBirthdate());
            $i++;
        }
        $objPHPExcel->getActiveSheet()->setTitle('Exemple');
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }

    public function executeView(sfWebRequest $request) {
        $this->player = Doctrine::getTable('teamPlayer')->findOneByUserId($request->getParameter('user_id'));
        $this->forward404Unless($this->player);
        if ($this->player->getSfGuardUser()->getIsActive() == 0):
            $this->notactive = true;
        else:
            $this->notactive = false;
        endif;
    }

    public function executeMap(sfWebRequest $request) {
/*        $this->users = Doctrine::getTable('sfGuardUser')->findAll();
        $this->users = Doctrine_Query::create()
          ->select('u.username, u.address, u.zipcode, u.city')
          ->from('sfGuardUser u')
          ->where('u.address IS NOT NULL')
          ->andWhere('u.zipcode IS NOT NULL')
          ->andWhere('u.city IS NOT NULL')
          ->orderBy('u.city DESC')
          ->execute();
*/
$this->setLayout('nologin');
    }

    public function executeSendActivation(sfWebRequest $request) {
        $user = Doctrine::getTable('sfGuardUser')->findOneById($request->getParameter('id'));
        $this->forward404Unless($user);

        $verified = sha1($user->getFirstName() . $user->getLastName() . $user->getEmailAddress());
        $link = '<a href="' . sfConfig::get('sf_root_url') . '/activate/' . $verified . $user->getId() . '">Cliquez ici pour activer votre compte.</a>';

        $mail = Doctrine::getTable('mail')->findOneByName('mail_user_new');
        $message = $this->getMailer()->compose();
        $message->setSubject($mail->getSubject());
        $message->setTo($user->getEmailAddress());
        $message->setFrom($mail->getEmail());
        $content = str_replace("%LINK%", $link, $mail->getContent());
        $content = str_replace("%PSEUDO%", $user->getUsername(), $content);
        $message->setBody($content);
        $this->getMailer()->send($message);

        $this->getUser()->setFlash('success', 'Le mail d\'activation de compte a ete renvoye au joueur.');
        $this->redirect('user/index');
    }

    public function executeSetPlayer(sfWebRequest $request) {
        $this->forward404Unless($teamplayer = Doctrine::getTable('teamPlayer')->findOneByUserId($request->getParameter('user_id', '')));
        if ($teamplayer->getIsPlayer() == 0):
            Doctrine::getTable('teamPlayer')
                    ->SetIsPlayer($teamplayer->getIdTeamPlayer());
        elseif ($teamplayer->getIsPlayer() == 1):
            Doctrine::getTable('teamPlayer')
                    ->UnsetIsPlayer($teamplayer->getIdTeamPlayer());
        endif;
        $this->redirect('user/view?user_id=' . $request->getParameter('user_id'));
    }

    public function executeSetCaptain(sfWebRequest $request) {
        $this->forward404Unless($teamplayer = Doctrine::getTable('teamPlayer')->findOneByUserId($request->getParameter('user_id', '')));
        if ($teamplayer->getIsCaptain() == 0):
            Doctrine::getTable('teamPlayer')
                    ->SetIsCaptain($teamplayer->getIdTeamPlayer());
        elseif ($teamplayer->getIsCaptain() == 1):
            Doctrine::getTable('teamPlayer')
                    ->UnsetIsCaptain($teamplayer->getIdTeamPlayer());
        endif;
        $this->redirect('user/view?user_id=' . $request->getParameter('user_id'));
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $user->delete();

        $this->redirect('user/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $user = $form->save();

            $this->redirect('user/edit?id=' . $user->getId());
        }
    }

    public function executeVerifMasters(sfWebRequest $request) {
        $this->user = Doctrine::getTable('sfGuardUser')->findOneById($request->getParameter('id'));
        $this->forward404Unless($this->user);

        $mfjv = new mfjv();
        $result = $mfjv->check($this->user->getLicenceMasters());
        if ($result):
            $this->test1 = 'ok';
        else:
            $this->test1 = 'fail';
        endif;

        $mfjv = new mfjv();
        $mfjv->setCriteria('first_name', $this->user->getFirstName());
        $result = $mfjv->check($this->user->getLicenceMasters());
        if ($result):
            $this->test2 = 'ok';
        else:
            $this->test2 = 'fail';
        endif;


        $mfjv = new mfjv();
        $mfjv->setCriteria('last_name', $this->user->getLastName());
        $result = $mfjv->check($this->user->getLicenceMasters());
        if ($result):
            $this->test3 = 'ok';
        else:
            $this->test3 = 'fail';
        endif;


        $mfjv = new mfjv();
        $mfjv->setCriteria('birthdate', $this->user->getBirthdate());
        $result = $mfjv->check($this->user->getLicenceMasters());
        if ($result):
            $this->test4 = 'ok';
        else:
            $this->test4 = 'fail';
        endif;
        
    }

}
