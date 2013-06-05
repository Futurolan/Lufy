<h3><?php echo __('Historique') ?></h3>

<ul class="invite">
<?php $i = 0; ?>
<?php foreach ($invites as $invite): ?>
  <?php if (!is_null($invite->getIsAccepted())):?>
    <?php $i++; ?>
    <li>
      <span class="label label-inverse"><?php echo format_date($invite->getCreatedAt(), 'dd/MM')?></span>
      <?php
      if ($invite->getIsAccepted()):
        echo __('Vous avez accepte l\'invitation a rejoindre l\'equipe').' '.$invite->getTeam()->getName();
      else:
        echo __('Vous avez refuse l\'invitation a rejoindre l\'equipe').' '.$invite->getTeam()->getName();
      endif;
      ?>
    </li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>

<?php if ($i == 0): ?>
  <div class="alert alert-info">
    <?php echo __('Vous n\'avez eu aucune invitation') ?>
  </div>
<?php endif; ?>

