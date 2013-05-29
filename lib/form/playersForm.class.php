<?php
class editTeamForm extends sfGuardUserForm {

   public function configure()
   {
     $this->widgetSchema['id']->setOption('renderer_class', 'sfWidgetFormJQueryAutocompleter');
    $this->widgetSchema['id']->setOption('renderer_options', array(
      'model' => 'SfGuardUser',
      'url'   => $this->getOption('url'),
    ));
   }

}
?>
