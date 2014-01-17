<h2><?php echo __('Ticket Weezevent')?></h2>

<?php if ($weezeventTicket->getbarcode()): ?>
  <div class="alert alert-info">
    <?php //echo __('Votre licence est valide pour la saison %1%.', array('%1%' => $licence->getSeason())); ?>
  </div>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo link_to('<i class="icon-trash"></i> '.__('Supprimer ma licence'), 'user/deleteWeezevent', array('class' => 'btn btn-danger')); ?>
        </td>
      </tr>
    </tfoot>
    <tr>
      <th><?php echo __('Code Barre'); ?></th>
      <td><?php echo $weezeventTicket->getbarcode();?></td>
    </tr>
  </table>
<?php else: ?>
  <p>
    <?php echo __('Si vous ne possedez pas de licence Masters du Jeu Video vous devez créer un compte sur le site')?>
    <a href="http://www.mastersjeuvideo.org" target="_blank">www.mastersjeuvideo.org</a>, <?php echo __('rendez-vous ensuite a la page')?>
    <a href="http://www.mastersjeuvideo.org/license/" target="_blank">http://www.mastersjeuvideo.org/license/</a>.<br/>
  </p>

  <?php include_partial('user/formWeezevent', array('form' => $form)); ?>
<?php endif; ?>
