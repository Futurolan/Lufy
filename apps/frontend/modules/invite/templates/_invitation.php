<h3><?php echo __('En attente') ?></h3>

<ul class="invite">
  <?php $i = 0; ?>
<?php foreach ($invites as $invite): ?>
  <?php if (is_null($invite->getIsAccepted())):?>
    <?php $i++; ?>
    <li class="well">
      <div>
        <small class="muted"><?php echo __('Recu le %1%', array('%1%' => format_date($invite->getCreatedAt(), 'dd MMMM y')))?></small>
      </div>
      <?php echo __('Vous avez recu une invitation pour rejoindre l\'equipe').' '.$invite->getTeam()->getName(); ?><br/>
      <div class="pull-right">
        <?php echo link_to(__('Accepter'), 'invite/acceptPlayer?id='.$invite->getIdInvite(), array('class' => 'btn btn-success btn-small')); ?>
        <?php echo link_to(__('Refuser'), 'invite/refusePlayer?id='.$invite->getIdInvite(), array('class' => 'btn btn-danger btn-small')); ?>
      </div>
      <div style="clear: right;"></div>
    </li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>

<?php if ($i == 0): ?>
  <div class="alert alert-info">
    <?php echo __('Vous n\'avez aucune invitation en attente') ?>
  </div>
<?php endif; ?>
