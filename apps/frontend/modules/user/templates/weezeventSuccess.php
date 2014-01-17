<h2><?php echo __('Ticket Weezevent')?></h2>

<?php// if ($licence->getSerial()): ?>
  <div class="alert alert-info">
    <?php //echo __('Votre licence est valide pour la saison %1%.', array('%1%' => $licence->getSeason())); ?>
  </div>
  
<?php //else: ?>
  <p>
    <?php echo __('Si vous ne possedez pas de licence Masters du Jeu Video vous devez créer un compte sur le site')?>
    <a href="http://www.mastersjeuvideo.org" target="_blank">www.mastersjeuvideo.org</a>, <?php echo __('rendez-vous ensuite a la page')?>
    <a href="http://www.mastersjeuvideo.org/license/" target="_blank">http://www.mastersjeuvideo.org/license/</a>.<br/>
  </p>

  <?php //include_partial('user/formLicenceMasters', array('form' => $form)); ?>
<?php //endif; ?>
