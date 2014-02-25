[?php

/**
 * <?php echo $this->getModuleName() ?> actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    Doctrine theme "lufy_backend"
 */

class <?php echo $this->getGeneratedModuleName() ?>Actions extends <?php echo $this->getActionsBaseClass() ?>
{

<?php include dirname(__FILE__).'/../../parts/indexAction.php' ?>


<?php if (isset($this->params['with_show']) && $this->params['with_show']): ?>
<?php include dirname(__FILE__).'/../../parts/viewAction.php' ?>
<?php endif; ?>


<?php include dirname(__FILE__).'/../../parts/formAction.php' ?>


<?php include dirname(__FILE__).'/../../parts/deleteAction.php' ?>
}
