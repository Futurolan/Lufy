1300008569<h2><?php echo __('Fiche joueur')?></h2>

<h3><?php echo $user->getFirstName() ?> "<?php echo $user->getUsername() ?>" <?php echo substr($user->getLastName(), 0, 1);?>.</h3>

<table class="table">
  <tr>
    <td align="center" valign="top" rowspan="6" width="160">
      <?php if ($user->getSfGuardUserProfile()->getLogourl()) { echo '<img src="'.$user->getSfGuardUserProfile()->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?>
    </td>
    <th><?php echo __('Inscrit le')?></th>
    <td>
      <?php echo  format_date($user->getCreatedAt(), 'dd/MM/yyyy')?>
    </td>
  </tr>
  <tr>
    <th><?php echo __('Equipe')?></th>
    <td>
      <?php
      $teamPlayers = $user->getTeamPlayer();
      foreach ($teamPlayers as $teamPlayer):
      ?>
        <a href="<?php echo url_for('team/view?slug=' . $teamPlayer->Team->slug) ?>"><?php echo $teamPlayer->Team->name ?></a>
      <?php endforeach; ?>
    </td>
  </tr>
  <tr>
    <th><?php echo __('Ville')?></th>
    <td><?php echo $user->getDefaultAddress()->getCity() ?></td>
  </tr>
  <tr>
    <th><?php echo __('Site web')?></th>
    <td><a href="<?php echo $user->getSfGuardUserProfile()->getWebsite() ?>"><?php echo $user->getSfGuardUserProfile()->getWebsite() ?></a></td>
  </tr>
  <tr>
    <th><?php echo __('Carriere')?></th>
    <td><?php echo $user->getSfGuardUserProfile()->getCarrer() ?></td>
  </tr>
</table>

<br/>
<?php if ($inviteteam == '1'): ?>
  <?php echo link_to(__('Inviter dans mon equipe'),'invite/addPlayer?username='.$user->getUsername(), array('class' => 'btn btn-primary'))?><br/>
<?php else: ?>
  <div class="alert alert-info">
    <?php echo __('Pour inviter ce joueur a rejoindre votre equipe vous devez etre fondateur ou manager.'); ?>
  </div>
  <div class="alert">
    <?php echo __('Vous ne pouvez pas inviter un joueur si celui ci appartient deja a une autre equipe.')?>
  </div>
<?php endif; ?>

<?php /* if ($invitefriend == '1'): ?>
<?php echo link_to('Inviter le joueur &agrave; etre mon ami','invite/addFriend?username='.$user->getUsername())?>
<?endif; */ ?>
