<?php

/**
 * Upload
 * 
 * @package    lufy
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Upload
{
  public function generateFileFilename(sfValidatedFile $file)
  {
    return $file>getOriginalName();
  }
}