<h2><?php echo __('Historique : ')?></h2>
<ul>
  <?php foreach ($invites as $invite): ?>
    <?php if ($invite->getIsAccepted() == 1):?>
      <li>
        <?php
          echo format_date($invite->getUpdated_at());
          echo (' : ');
          echo __('Vous avez rejoint : ');
          echo ($invite->getTeam()->getName());
        ?>
      </li>
    <?php elseif (!is_null($invite->getIsAccepted()) /*&& $invite->getIsAccepted() === 0*/): ?>
      <li>
        <?php
          echo format_date($invite->getUpdated_at());
          echo (' : ');
          echo __('Vous avez décliné l\'invitation de ');
          echo ($invite->getTeam()->getName());
        ?>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>


