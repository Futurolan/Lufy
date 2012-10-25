<?php

class IpnPaypalTable extends Doctrine_Table 
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('IpnPaypal');
    }

    public function checkById($id)
    {
        $ipn = $this->getInstance()->findOneById($id);
        if ($ipn->getIsChecked() == 0)
        {
            $ipn->setIsChecked(1);
        }
        else
        {
            $ipn->setIsChecked(0);
        }
        $ipn->save();
    }
}
