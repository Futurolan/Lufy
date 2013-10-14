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
  public function preExecute()
  {
    sfConfig::set('sf_escaping_strategy', false);
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }

  public function executeInscriptions(sfWebRequest $request)
  {
    $this->users = Doctrine::getTable('sfGuardUser');
    $this->players = Doctrine::getTable('teamPlayer');
    $this->teams = Doctrine::getTable('team');
    $this->slotsValid = Doctrine::getTable('tournamentSlot')->findByStatus('valide');
    $this->tournaments = Doctrine::getTable('tournament')->findByIsActive('1');
  }

  public function executeNews(sfWebRequest $request)
  {
    sfConfig::set('sf_escaping_strategy', false);

    $news = Doctrine_Query::create()
      ->select('n.publish_on')
      ->from('News n')
      ->where('n.status = ?', 1)
      ->orderBy('publish_on ASC')
      ->execute();

    $nb_news = $news->count();

    $comments = Doctrine_Query::create()
      ->from('comment c')
      ->where('c.status = ?', 1)
      ->orderBy('created_at ASC')
      ->execute();

    $nb_comments = $comments->count();

    $start_at = new DateTime($news[0]->getPublishOn());
    $current = $start_at;
    $now = new DateTime('now');

    $diff_days = $start_at->diff($now)->format('%a');

    $this->data = array();
    $this->data[] = array('Date', 'Nb news');

    $this->dataa = array();
    $this->dataa[] = array('Date', 'Nb commentaires');

    $j = 0;
    $k = 0;
    $l = 0;
    $count_news = 0;
    $count_comments = 0;

    for ($i=0; $i<= $diff_days; $i++)
    {
      if ($count_news < $nb_news-1)
      {
        for ($j=0; $j<=99; $j++)
        {
          $news_datetime = new DateTime($news[$k]->getPublishOn());

          if ($news_datetime->diff($current)->format('%a') == 0)
          {
            $count_news++;
            $k++;
          }
          else
          {
            break;
          }
        }
      }

      $j = 0;

      if ($count_comments < $nb_comments-1)
      {
        for ($j=0; $j<=99; $j++)
        {
          $comment_datetime = new DateTime($comments[$l]->getCreatedAt());

          if ($comment_datetime->diff($current)->format('%a') == 0)
          {
            $count_comments++;
            $l++;
          }
          else
          {
            break;
          }
        }
      }

      $this->data[] = array(date_format($current, 'd-m-Y'), $count_news);
      $this->dataa[] = array(date_format($current, 'd-m-Y'), $count_comments);

      $current->add(new DateInterval('P1D'));
    }


    $news = Doctrine_Query::create()
      ->select('n.slug')
      ->from('News n')
      ->where('n.status = ?', 1)
      ->execute();

    $news_fr = 0;
    $news_en = 0;

    foreach ($news as $elem)
    {
      if (substr($elem->getSlug(), -3, 3) == '-en')
      {
        $news_en++;
      }
      else
      {
        $news_fr++;
      }
    }

    $this->data2 = array(
      array('Langue', 'Nb news'),
      array('Francais', $news_fr),
      array('Anglais', $news_en)
    );


    $categories = Doctrine_Query::create()
      ->from('NewsType t')
      ->orderBy('t.label ASC')
      ->execute();

    $this->data3 = array();
    $this->data3[] = array('Categories', 'Nb news');

    foreach ($categories as $elem)
    {
      $this->data3[] = array($elem->getLabel(), $elem->getNews()->count());
    }
  }

  public function executeUser(sfWebRequest $request)
  {
    $users = Doctrine_Query::create()
      ->select('u.birthdate')
      ->from('sfGuardUser u')
      ->where('u.birthdate IS NOT NULL')
      ->andWhere('u.birthdate != ""')
      ->orderBy('birthdate DESC')
      ->execute();

    $this->data = array();
    $current_year = date('Y');

    foreach ($users as $elem)
    {
      $age = $current_year-substr($elem->getBirthdate(), 0, 4);

      if (!array_key_exists($age, $this->data))
      {
        $this->data[$age] = 0;
      }

      $this->data[$age]++;
    }

    $data = array();

    foreach ($this->data as $k=>$v)
    {
      if ($k > 5 && $k < 60)
      {
        $data[] = array($k.' ans', $v);
      }
    }

    $this->data = $data;

  }

  public function executeTshirt(sfWebRequest $request)
  {
    sfConfig::set('sf_escaping_strategy', false);

    $this->total = count(Doctrine::getTable('Tshirt')->findAll());
    $this->total = count(Doctrine::getTable('Tshirt')->findAll());
    $this->size_s = round(count(Doctrine::getTable('Tshirt')->findBySize('S')) * 100 / $this->total, 1);
    $this->size_m = round(count(Doctrine::getTable('Tshirt')->findBySize('M')) * 100 / $this->total, 1);
    $this->size_l = round(count(Doctrine::getTable('Tshirt')->findBySize('L')) * 100 / $this->total, 1);
    $this->size_xl = round(count(Doctrine::getTable('Tshirt')->findBySize('XL')) * 100 / $this->total, 1);
    $this->size_xxl = round(count(Doctrine::getTable('Tshirt')->findBySize('XXL')) * 100 / $this->total, 1);
    $this->size_xxxl = round(count(Doctrine::getTable('Tshirt')->findBySize('XXXL')) * 100 / $this->total, 1);

    $this->data = array(
      array('Taille', '%'),
      array('S', $this->size_s),
      array('M', $this->size_m),
      array('L', $this->size_l),
      array('XL', $this->size_xl),
      array('XXL', $this->size_xxl),
      array('XXXL', $this->size_xxxl),
    );
  }
}
