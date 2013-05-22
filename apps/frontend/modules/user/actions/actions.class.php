<?php

/**
 * user actions.
 *
 * @package    lufy
 * @subpackage user
 * @author     Lufy, HumanG33k
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends FrontendActions
{
  public function postExecute()
  {
    $this->setLayout('user');
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('user/profile');
  }

  public function executeBulletin(sfWebRequest $request)
  {
      $this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
      if (!$this->user->getLicenceGa())
      {
        $id = $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser');
        $l = Doctrine::getTable('varConfig')->getEanNextPlayer();

        Doctrine::getTable('sfGuardUser')->setLicenceGa($l, $id);

        $k = substr($l, 0, 12);
        $k = $k + 1;

        for ($i = 0; $i < 12; $i++)
        {
          $EAN13[$i] = substr($k, $i, 1);
        }

        $pair = 0;

        for ($u = 0; $u < 12; $u = $u + 2)
        {
          $pair = $pair + $EAN13[$u];
        }

        $impair = 0;

        for ($y = 1; $y < 12; $y = $y + 2)
        {
          $impair = $impair + $EAN13[$y] * 3;
        }

        $total = $pair + $impair;
        $r = fmod($total, 10);
        $controlkey = 10 - $r;
        $n = str_pad($k, 13, $controlkey, STR_PAD_RIGHT);

        Doctrine::getTable('varConfig')->UpdateEanNextPlayer($n);

        $this->redirect('user/bulletin');
      }

      foreach ($this->user->getTeam() as $team){
        $this->tournaments = Doctrine_Query::create()
          ->select('*')
          ->from('tournamentSlot t1, tournament t2')
          ->where('t1.tournament_id = t2.id_tournament')
          ->andWhere('t1.team_id = ' . $team->getIdTeam())
          ->execute();
      }

      $this->setLayout('print');
  }


  public function executeView(sfWebRequest $request)
  {
    $this->user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username', ''));
    $this->forward404Unless($this->user);

    // team : notinteam, notininvitationteam,
    $t = Doctrine::getTable('invite')->isInvitedInTeam($this->user->getId());
    $t2 = Doctrine::getTable('team')->isInTeam($this->user->getId());

    // droits : adminteam ou captain
    $d = Doctrine::getTable('sfGuardUser')->isCaptain();
    $d2 = Doctrine::getTable('sfGuardUser')->isAdmin();
    $this->inviteteam = '0';

    if ($t == false && $t2 == false)
    {
      if ($d == true || $d2 == true)
      {
        $this->inviteteam = '1';
      }
    }

    // friend : notFriend, notininvitationfriend,
    $f = Doctrine::getTable('invite')->isInvitedFriend($this->user->getId());
    $f2 = Doctrine::getTable('friend')->isFriend($this->user->getId());

    $this->invitefriend = '0';
    if ($f == false && $f2 == false)
    {
      $this->invitefriend = '1';
    }

    if ($this->user->getId() == $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser') || $this->getUser()->isAuthenticated() == false)
    {
      $this->invitefriend = '0';
    }
  }


  public function executeProfile(sfWebRequest $request)
  {
      $this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
  }


  public function executeEditProfile(sfWebRequest $request)
  {
    $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));

    $this->form = new profilForm($user);

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($this->processForm($request, $this->form))
      {
        $this->redirect('user/profile');
      }
    }
  }


  public function executeAddress(sfWebRequest $request){
    $this->addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
  }


public function executeNewAddress(sfWebRequest $request)
{
  $object = new SfGuardUserAddress();
  $object->setUserId($this->getUser()->getGuardUser()->getId());
   $first = $this->getUser()->getGuardUser()->getSfGuardUserAddress()->count();
  if ($first == 0 )
  {
    $object->setIsDefault(1);
    $object->setIsBilling(1);
    $object->setIsDelivery(1);
  }
  $this->form = new SfGuardUserAddressForm($object);

  if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
  {
    if ($this->processForm($request, $this->form))
    {
      $this->redirect('user/address');
    }
  }
  }


  public function executeEditAddress(sfWebRequest $request)
  {
    $this->forward404Unless($address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId()));

    $this->form = new SfGuardUserAddressForm($address);

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($this->processForm($request, $this->form))
      {
        $this->redirect('user/address');
      }
    }
  }


  public function executeSetDefaultAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    $addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
    foreach ($addresses as $other_address)
    {
      $other_address->setIsDefault(0);
      $other_address->save();
    }

    $address->setIsDefault(1);
    $address->save();

    $this->redirect('user/address');
  }


  public function executeSetBillingAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    $addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
    foreach ($addresses as $other_address)
    {
      $other_address->setIsBilling(0);
      $other_address->save();
    }

    $address->setIsBilling(1);
    $address->save();

    $this->redirect('user/address');
  }


  public function executeSetDeliveryAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    $addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
    foreach ($addresses as $other_address)
    {
      $other_address->setIsDelivery(0);
      $other_address->save();
    }

    $address->setIsDelivery(1);
    $address->save();

    $this->redirect('user/address');
  }


  public function executeDeleteAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    if ($address->getIsDefault())
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Impossible de supprimer une adresse par defaut.'));
      $this->redirect('user/address');
    }

    if ($address->getIsBilling())
    {
      $default_address = $this->getUser()->getGuardUser()->getDefaultAddress();
      $default_address->setIsBilling(1);
      $default_address->save();
    }

    if ($address->getIsDelivery())
    {
      $default_address = $this->getUser()->getGuardUser()->getDefaultAddress();
      $default_address->setIsDelivery(1);
      $default_address->save();
    }

    $address->delete();

    $this->getUser()->setFlash('success', $this->getContext()->getI18n()->__('L\adresse selectionnee a ete supprimee.'));
    $this->redirect('user/address');
  }

  /**
 * Add a Masters licence on the current user
 */
  public function executeLicenceMasters(sfWebRequest $request)
  {
      $this->forward404Unless($user = Doctrine::getTable('SfGuardUser')->findOneById($this->getUser()->getGuardUser()->getId()));
      $this->licence = $user->getSfGuardUserLicenceMasters();

      if(!$this->licence)
      {
        $this->licence = new SfGuardUserLicenceMasters();
        $this->licence->setUserId($user->getId());
      }

      $this->form = new SfGuardUserLicenceMastersForm($this->licence);

      if ($request->isMethod(sfRequest::POST))
      {
        $this->processFormLicenceMasters($request, $this->form);
        //$this->redirect('user/licenceMasters');
      }
  }

/*
 *
 *
 */
  protected function processFormLicenceMasters(sfWebRequest $request, sfForm $form)
  {
    $mfjv = new mfjv();
    $mfjv->setCriteria('last_name', $this->getUser()->getGuardUser()->getLastName());
    $serial = $request->getPostParameter('sf_guard_user_licence_masters[serial]');
    $result = $mfjv->check($serial);
    if( $result )
    {
      $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
      if ($result->season == '2012-2013')
      {
        if ($this->licence)
        {
          $this->licence->setType($result->type);
          $this->licence->setSerial($result->serial);
          $this->licence->setUsername($result->username);
          $this->licence->setSeason($result->season);
          $this->licence->setUsed($result->used);
          $this->licence->save();

          $this->getUser()->setFlash('success','Votre Licence Masters a ete verifiee.');
          $this->redirect('user/licenceMasters');
        }
        else
        {
          $this->getUser()->setFlash('error','humm comment dire erreur de developpement');
          $this->redirect('user/licenceMasters');
        }
      }
      else
      {
        $this->getUser()->setFlash('error','Votre licence n\'est pas valide pour la saison en cours');
      }
    }
    else
    {
      $this->getUser()->setFlash('error','Licence inexistante et/ou nom ne correspondant pas, si les informations sont correctement remplis le site des masters est peut etre injoingnable, veuillez reessayer ulterieurement');
    }
  }




/**
 * Return and set the tshirt size for the current user
 */
  public function executeTshirt(sfWebRequest $request)
  {
      $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
      $tshirt = $user->getSfGuardUserTshirt();

      if (!$tshirt){
        $tshirt = new SfGuardUserTshirt();
        $tshirt->setUserId($user->getId());
      }

      $this->form = new SfGuardUserTshirtForm($tshirt);

      if ($request->isMethod(sfRequest::POST)){
        $this->processForm($request, $this->form);
        $this->redirect('user/tshirt');
      }
  }


    public function executePassword(sfWebRequest $request)
  {
    //$this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new passwordForm($this->user);
    if($this->embeddedProcessForm($request, 'password'))
    {
      $this->getUser()->setFlash('success', 'Le mot de passe a bien été modifié.');
    }

  }




}

