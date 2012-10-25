<?php

class PayementTable extends Doctrine_Table {

    public static function getInstance() {
        return Doctrine_Core::getTable('Payement');
    }

    public function insertPrepayment($commande_id, $idcashman, $amount) {
        $pay = new Payement();
        $pay->setCommandeId($commande_id);
        $pay->setUserCashmanId($idcashman);
        $pay->setAmount($amount);
        $pay->setCurrencyCode('EUR');
        $pay->setIsValid('0');
        $pay->setIsPaypal('1');
        $pay->save();
    }

    public function insertPayment($commande_id, $idcashman, $txn_id, $amount, $currency) {
        $pay = new Payement();
        $pay->setCommandeId($commande_id);
        $pay->setUserCashmanId($idcashman);
        $pay->setTxnId($txn_id);
        $pay->setAmount($amount);
        $pay->setCurrencyCode($currency);
        $pay->setIsValid('1');
        $pay->setIsPaypal('1');
        $pay->save();
    }

    public function insertPaymentCheque($commande_id, $idcashman, $amount, $currency) {
        $pay = new Payement();
        $pay->setCommandeId($commande_id);
        $pay->setUserCashmanId($idcashman);
        $pay->setAmount($amount);
        $pay->setCurrencyCode($currency);
        $pay->setIsValid('0');
        $pay->setIsPaypal('0');
        $pay->save();
    }

}