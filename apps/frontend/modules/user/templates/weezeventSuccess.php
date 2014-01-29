<h2><?php echo __('Ticket Weezevent')?></h2>

<?php if ($weezevent->getBarcode()): ?>

  <br/><br/>
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
      <td><?php echo $weezevent->getBarcode();?></td>
    </tr>
  </table>
<?php else: ?>
  <p>
  <div>
    Afin de valider votre participation vous devez saisir le numero de votre billet Weezevent.<br/>
    Ce num&eacute;ro unique ce trouve a l'endroit indiqu&eacute; sur l'image ci-dessous.
  </div>
  <br/>
    <?php echo __('Si vous ne possedez pas de billet weezevent vous pouvez vous en procurer un via notre boutique Gamers Assembly 2014')?>
  </p>
  <br/>
  <?php include_partial('user/formWeezevent', array('form' => $form)); ?>

  <?=image_tag('ticket_ga2014.jpg')?>
<?php endif; ?>
