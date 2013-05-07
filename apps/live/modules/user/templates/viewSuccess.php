<?php use_helper('Date') ?>
<div class="box">
    <div class="title"><?php echo __('Fiche joueur')?></div>
    <div class="content">
    <h4><?php echo image_tag('/css/img/flag/'.$user->getCountry().'.png')?> <?php echo  $user->getFirstName() ?> "<?php echo  $user->getUsername() ?>" <?php echo substr($user->getLastName(), 0, 1);?>.</h4>
    <table class="profil1">
        <tr>
            <td align="center" valign="top" rowspan="6" width="160">
                <?php if ($user->getLogourl()) { echo '<img src="'.$user->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?>
            </td>
            <td><?php echo __('Inscrit le')?></td>
            <td>
                <?php echo  format_date($user->getCreatedAt(), 'dd/MM/yyyy')?>
            </td>
        </tr>
        <tr>
            <td><?php echo __('Equipe')?></td>
            <td><?php
                $teamPlayers = $user->getTeamPlayer();
                foreach ($teamPlayers as $teamPlayer): ?>
                    <a href="<?php echo  url_for('team/view?slug=' . $teamPlayer->Team->slug) ?>"><?php echo  $teamPlayer->Team->name ?></a>
                <?php endforeach;
                ?></td>
        </tr>
        <tr>
                <td><?php echo __('Ville')?></td>
                <td><?php echo  $user->getCity() ?></td>
        </tr>
        <tr>
                <td><?php echo __('Site web')?></td>
                <td><a href="<?php echo  $user->getWebsite() ?>"><?php echo  $user->getWebsite() ?></a></td>
        </tr>
        <tr>
                <td><?php echo __('Carriere')?></td>
                <td><?php echo  $user->getCarrer() ?></td>
        </tr>
    </table>
    </div>
</div>
