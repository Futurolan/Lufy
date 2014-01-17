<h2><?php echo __('Ticket Weezevent')?></h2>

<?php if ($weezevent->getbarcode()): ?>
  <div class="alert alert-info">
    <?php echo __('Votre ticket est valide'); ?>
  </div>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo link_to('<i class="icon-trash"></i> '.__('Supprimer mon ticket'), 'user/deleteWeezevent', array('class' => 'btn btn-danger')); ?>
        </td>
      </tr>
    </tfoot>
    <tr>
      <th><?php echo __('Code Barre'); ?></th>
      <td><?php echo $weezevent->getbarcode();?></td>
    </tr>
  </table>
<?php else: ?>
  <p>
    <?php echo __('Si vous ne possedez pas de billet weezevent vous pouvez vous en procurer un sur leur site')?>
  </p>

  <?php include_partial('user/formWeezevent', array('form' => $form)); ?>
<?php endif; ?>
