<? use_helper('Date') ?>
<div class="box">
    <div class="title"><?=__('Mon profil')?></div>
    <div class="content">
    <? if ($sf_user->isAuthenticated()) {
    ?>
    
            <h4><?=image_tag('/css/img/flag/'.$user->getCountry().'.png')?> <?= $user->getFirstName() ?> "<?= $user->getUsername() ?>" <?= $user->getLastName() ?></h4>
            <table class="profil">
                <tr>
            <td align="center" valign="top" rowspan="9" width="160">
                <? if ($user->getLogourl()) { echo '<img src="'.$user->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
            </td>
            <td><?=__('Inscrit le')?></td>
            <td>
                <?= format_date($user->getCreatedAt(), 'dd/MM/yyyy')?>
            </td>
        </tr>
        <tr>
            <td><?=__('Age / Sexe')?></td>
            <td><?= format_date($user['birthdate'], 'dd/MM/yyyy') ?> / <?= $user['gender'] ?></td>
        </tr>
        <tr>
            <td><?=__('Equipe')?></td>
            <td><?php
                $teamPlayers = $user->getTeamPlayer();
                foreach ($teamPlayers as $teamPlayer): ?>
                    <a href="<?= url_for('team/view?slug=' . $teamPlayer->Team->slug) ?>"><?= $teamPlayer->Team->name ?></a>
                <?php endforeach;
                ?></td>
            </tr>
            <tr>
                <td><?=__('Licence Masters')?></td>
                <td><?= $user->getLicenceMasters() ?></td>
            </tr>
            <tr>
                <td><?=__('Telephone')?></td>
                <td><?= $user->getPhone() ?></td>
            </tr>
            <tr>
                <td><?=__('Adresse')?></td>
                <td><?= $user->getAddress() ?><br/>

                <?= $user->getZipCode() ?> - <?= $user->getCity() ?><br/>

                <?= $user->getCountry() ?></td>
            </tr>
            <tr>
                <td><?=__('Site web')?></td>
                <td><a href="<?= $user->getWebsite() ?>"><?= $user->getWebsite() ?></a></td>
            </tr>
            <tr>
                <td><?=__('Carriere')?></td>
                <td><?= $user->getCarrer() ?></td>
            </tr>
        </table>
        <br /><br />
        <a class="button" href="<?= url_for('user/edit') ?>"><?=__('Editer mon profil')?></a> 
        <a class="button" href="<?= url_for('user/view?username=' . $user->username) ?>"><?=__('Voir mon profil publique')?></a>
        
    <?
                } ?>
    </div>
</div>
