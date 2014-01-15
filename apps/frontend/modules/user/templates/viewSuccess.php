<?php use_helper('Date') ?>
<h2><?php echo __('Fiche joueur')?></h2>
<h3><?php echo  $user->getFirstName() ?> "<?php echo  $user->getUsername() ?>" <?php echo substr($user->getLastName(), 0, 1) ?>.</h3>
<table class="table">
  <tr>
      <td align="center" valign="top" rowspan="9" width="160">
        <?php if ($user->getSfGuardUserProfile()->getLogourl()) { echo '<img src="'.$user->getSfGuardUserProfile()->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
      </td>
      <td>
        <?php echo __('Inscrit le')?>
      </td>
      <td>
        <?php echo  format_date($user->getCreatedAt(), 'dd/MM/yyyy')?>
      </td>
  </tr>
  <tr>
      <td>
        <?php echo __('Age / Sexe')?>
      </td>
      <td>
        <?php echo format_date($user->getSfGuardUserProfile()->getBirthdate(), 'yyyy') ?>
        <?php echo '/'; ?>
        <?php echo $user->getSfGuardUserProfile()->getGender() ?>
      </td>
  </tr>
  <tr>
    <td>
      <?php echo __('Equipes')?>
    </td>
    <td><?php
        $teamPlayers = $user->getTeamPlayer();
        foreach ($teamPlayers as $teamPlayer): ?>
            <a href="<?php echo  url_for('team/view?slug=' . $teamPlayer->Team->slug) ?>"><?php echo  $teamPlayer->Team->name ?></a><?php echo ' |'; ?>
        <?php endforeach;
        ?>
    </td>
  </tr>
  <tr>
    <td>
      <?php echo __('Site web')?>
    </td>
    <td>
      <a href="<?php echo $user->getSfGuardUserProfile()->getWebsite() ?>"><?php echo $user->getSfGuardUserProfile()->getWebsite() ?></a>
    </td>
  </tr>
  <tr>
    <td><?php echo __('Carriere')?></td>
    <td><?php echo  $user->getSfGuardUserProfile()->getCarrer() ?></td>
  </tr>
</table>
