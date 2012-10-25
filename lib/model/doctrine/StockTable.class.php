<?php
/**
 * Stock
 *
 * @package    lufy
 * @subpackage model
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 */

class StockTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Stock');
    }
}
