<?php

/**
 * reader actions.
 *
 * @package    lufy
 * @subpackage reader
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class readerActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeView(sfWebRequest $request)
  {
    $this->slug = $request->getParameter('slug');
    $this->display = ($request->getParameter('display')) ? $request->getParameter('display') : 'double';

    $pages = array();
    $files = sfFinder::type('file')->maxdepth(0)->name('*')->relative()->in(sfConfig::get('sf_upload_dir').'/presse/reader/'.$this->slug.'/');

    foreach ($files as $file)
    {
      if (substr($file, -3, 3) == 'jpg') $pages[] = str_replace('.jpg', '', $file);
    }

    sort($pages);
    $this->nb_pages = count($pages);

    $i = 0;
    $this->magazine = array();
    for ($i=0; $i < $this->nb_pages; $i++)
    {
      $this->magazine[] = $pages[$i];
    }

    $this->pdf = false;
    if (file_exists(sfConfig::get('sf_upload_dir').'/presse/reader/'.$this->slug.'/'.$this->slug.'.pdf')) $this->pdf = true;
  }
}
