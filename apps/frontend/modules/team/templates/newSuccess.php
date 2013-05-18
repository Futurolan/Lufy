<h2><?php echo __('Creer une equipe')?></h2>

<div class="alert alert-info">
  <?php echo __('Vous pouvez appartenir a une seule equipe. Si un membre a deja cree une equipe vous devez lui demander de vous inviter.')?>
</div>

<?php include_partial('form', array('form' => $form)) ?>
