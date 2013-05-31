<?php

/**
 * stats actions.
 *
 * @package    lufy
 * @subpackage stats
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statsActions extends sfActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeInscriptions(sfWebRequest $request)
  {
    $this->users = Doctrine::getTable('sfGuardUser');
    $this->players = Doctrine::getTable('teamPlayer');
    $this->teams = Doctrine::getTable('team');
    $this->slotsValid = Doctrine::getTable('tournamentSlot')->findByStatus('valide');
    $this->tournaments = Doctrine::getTable('tournament')->findByIsActive('1');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeAnalytic(sfWebRequest $request)
  {
    $this->ga = new gapi(sfConfig::get('app_google_account_mail'), sfConfig::get('app_google_account_password'));

//    $this->ga->requestReportData(145141, array('browser','browserVersion'),array('pageviews','visits'));

    $this->ga->requestReportData(145141242, 'week', 'visits', 'week');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeTshirt(sfWebRequest $request)
  {
    $this->total = count(Doctrine::getTable('Tshirt')->findAll());
    $this->size_s = round(count(Doctrine::getTable('Tshirt')->findBySize('S')) * 100 / $this->total, 1);
    $this->size_m = round(count(Doctrine::getTable('Tshirt')->findBySize('M')) * 100 / $this->total, 1);
    $this->size_l = round(count(Doctrine::getTable('Tshirt')->findBySize('L')) * 100 / $this->total, 1);
    $this->size_xl = round(count(Doctrine::getTable('Tshirt')->findBySize('XL')) * 100 / $this->total, 1);
//print count(Doctrine::getTable('Tshirt')->findBySize('XL')); exit;
    $this->size_xxl = round(count(Doctrine::getTable('Tshirt')->findBySize('XXL')) * 100 / $this->total, 1);
    $this->size_xxxl = round(count(Doctrine::getTable('Tshirt')->findBySize('XXXL')) * 100 / $this->total, 1);
  }

}
