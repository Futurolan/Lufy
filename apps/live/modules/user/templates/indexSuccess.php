<div class="box">
    <div class="title"><?php echo __('Espace perso')?></div>
    <div class="content">
<table width="100%">
    <tr>
        <td><h4><?php echo __('Informations personnelles')?></h4></td>
        <td><h4><?php echo __('Competition / Inscription')?></h4></td>
    </tr>
    <tr valign="top">
        <td>
            <ul>
                <li><?php echo link_to(__('Modifier mes informations'), 'user/edit')?></li>
                <li><?php echo link_to(__('Voir mon profil public'), 'user/'.$sf_user->getUsername())?></li>
                <li><?php echo link_to(__('Taille du tee-shirt'), 'user/tshirt')?></li>
                <li><?php echo link_to(__('Mes invitations'), 'invite/index')?> <?php include_component('invite', 'nbinvite') ?></li>
            </ul>
        </td>
        <td>
            <ul>
		<li><?php echo link_to(__('Mon &eacute;quipe'), 'team/index')?></li>
                <li><?php echo link_to(__('Ma licence Masters'), 'user/licence')?></li>
		<?php if ($isInscrit == true) { ?>
		    <li><a href="<?php echo url_for('tournament_slot/index')?>"><?php echo __('Gerer mon inscription')?></a></li>
		<?php } 
		else { ?>
		    <li><a href="<?php echo url_for('tournament/index')?>"><?php echo __('Inscription a la Gamers Assembly')?></a></li>
		<?php } ?>
            </ul>
            <br/>
            <i style="color: red;"><?php echo __('DOCUMENT(S) A IMPRIMER')?> :</b>
            <ul>
                <li><a href="http://www.gamers-assembly.net/fr/bulletin" target="_blank"><?php echo __('Bulletin d inscription')?></a></li>
		<!--
                <li><a href="http://www.gamers-assembly.net/uploads/files/pdf/fiche_materiel.pdf" target="_blank">Fiche mat&eacute;riel</a></li>
		-->
                <li><a href="../../../../uploads/files/autorisation-parentale.pdf" target="_blank"><?php echo __('Autorisation parentale')?></a> <i>(<?php echo __('pour les joueurs mineurs')?>)</i></li>
            </ul>
        </td>
    </tr>
</table>

    </div>
</div>
