<?php

/**
 * feed actions.
 *
 * @package    lufy
 * @subpackage feed
 * @author     Guillaume Marsay
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class feedActions extends sfActions
{


  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeRss2()
  {
    sfApplicationConfiguration::getActive()->loadHelpers('bb');
    sfApplicationConfiguration::getActive()->loadHelpers('Url');
    sfApplicationConfiguration::getActive()->loadHelpers('Asset');

    $feed = new sfRss201Feed();

    $feed->setTitle('Gamers Assembly');
    $feed->setLink('http://www.gamers-assembly.net/');
    $feed->setAuthorEmail('contact@futurolan.net');
    $feed->setAuthorName('Association Futurolan');

    $newss = Doctrine_Query::create()
            ->select('*')
            ->from('news')
            ->where('status = 1')
            ->andWhere('slug NOT LIKE "%-en"')
            ->orderby('publish_on DESC')
            ->limit('limit', 10)
            ->execute();

    foreach ($newss as $news)
    {
      $item = new sfFeedItem();
      $item->setTitle($news->getTitle());
      $item->setLink('news/view?slug=' . $news->getSlug());
      $item->setPubdate(strtotime($news->getPublishOn()));
      $item->setUniqueId($news->getSlug());
      $item->setDescription(substr(bb_parse($news->getContent()), 0, 400));

      $feed->addItem($item);
    }

    $this->feed = $feed;
  }

}
