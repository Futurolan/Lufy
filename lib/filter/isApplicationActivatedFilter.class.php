<?php
class isApplicationActivatedFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    if ($this->isFirstCall())
    {
      if (sfConfig::get('sf_check_lock'))
      {
        $context = $this->getContext();
        $config = $context->getConfiguration();
        $user = $context->getUser();

        $fileLock = $config->getApplicationLockFile();
        if (file_exists($fileLock) && !$user->isSuperAdmin())
        {
          $file = sfConfig::get('sf_web_dir').'/maintenance.php';
          if (is_readable($file))
          {
            include $file;
            //break;
          }
          die(1);
        }
      }
    }
    $filterChain->execute();
  }
}
