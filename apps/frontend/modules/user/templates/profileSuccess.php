<?php use_helper('Date') ?>
<div class="box">
    <div class="title"><?php echo __('Mon profil')?></div>
    <div class="content">
            <h4><?php echo  $user->getFirstName() ?> "<?php echo  $user->getUsername() ?>" <?php echo  $user->getLastName() ?></h4>
            <table class="profil">
                <tr>
            <td align="center" valign="top" rowspan="9" width="160">
                <?php if ($user->getSfGuardUserProfile()->getLogourl()) { echo '<img src="'.$user->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
            </td>
            <td><?php echo __('Inscrit le')?></td>
            <td>
                <?php echo  format_date($user->getCreatedAt(), 'dd/MM/yyyy')?>
            </td>
        </tr>
        <tr>
            <td><?php echo __('Age / Sexe')?></td>
            <td><?php echo format_date($user->getSfGuardUserProfile()->getBirthdate(), 'dd/MM/yyyy') ?> / <?php echo $user->getSfGuardUserProfile()->getGender() ?></td>
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
                <td><?php echo __('Telephone')?></td>
                <td><?php echo  $user->getSfGuardUserProfile()->getPhone() ?></td>
            </tr>
            <tr>
                <td><?php echo __('Site web')?></td>
                <td><a href="<?php echo $user->getSfGuardUserProfile()->getWebsite() ?>"><?php echo $user->getSfGuardUserProfile()->getWebsite() ?></a></td>
            </tr>
            <tr>
                <td><?php echo __('Carriere')?></td>
                <td><?php echo  $user->getSfGuardUserProfile()->getCarrer() ?></td>
            </tr>
        </table>
        <br /><br />
        <a class="button" href="<?php echo  url_for('user/edit') ?>"><?php echo __('Editer mon profil')?></a>
        <a class="button" href="<?php echo  url_for('user/view?username=' . $user->username) ?>"><?php echo __('Voir mon profil publique')?></a>
        
    </div>
</div>
