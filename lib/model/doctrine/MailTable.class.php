<?php


class MailTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Mail');
    }
    
    public function updateEmail($mail_name, $email)
    {
        Doctrine_Query::create()
            ->update('Mail')
            ->set('email', '?', $email)
            ->where('name = ?', $mail_name)
            ->execute();
    }
}