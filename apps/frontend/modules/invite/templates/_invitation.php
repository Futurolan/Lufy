<h3><?php echo __('En cours') ?></h3>

<ul class="invite">
  <?php $i = 0; ?>
<?php foreach ($invites as $invite): ?>
  <?php if (is_null($invite->getIsAccepted())):?>
    <?php $i++; ?>
    <li>
      <span class="label label-inverse"><?php echo format_date($invite->getCreatedAt(), 'dd/MM')?></span>
      <?php
      echo __('Vous avez recu une invitation pour rejoindre l\'equipe').' '.$invite->getTeam()->getName().' ';
      echo link_to(__('Accepter'), 'invite/acceptPlayer?id='.$invite->getIdInvite(), array('class' => 'btn btn-success btn-small'));
      echo (' ');
      echo link_to(__('Refuser'), 'invite/refusePlayer?id='.$invite->getIdInvite(), array('class' => 'btn btn-danger btn-small'));
      echo '<br/>';?>
    </li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>

<?php if ($i == 0): ?>
  <div class="alert alert-info">
    <?php echo __('Vous n\'avez aucune invitation pour le moment') ?>
  </div>
<?php endif; ?>
