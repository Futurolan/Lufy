<div class="box">
    <div class="title"><?=__('Espace perso')?></div>
    <div class="content">
    <table width="100%">
    <tr>
        <td><div class="subtitle"><?=__('Informations personnelles')?></div></td>
        <td><div class="subtitle"><?=__('Competition / Inscription')?></div></td>
    </tr>
    <tr valign="top">
        <td>
            <ul>
                <li><?=link_to(__('Modifier mes informations'), 'user/edit')?></li>
                <li><?=link_to(__('Voir mon profil public'), 'user/'.$sf_user->getUsername())?></li>
<!--                <li><?=link_to(__('Taille du tee-shirt'), 'user/tshirt')?></li> -->
                <li><?=link_to(__('Mes invitations'), 'invite/index')?> <?php include_component('invite', 'nbinvite') ?></li>
            </ul>
        </td>
        <td>
            <ul>
		<li><?=link_to(__('Mon &eacute;quipe'), 'team/index')?></li>
<!--                <li><?=link_to(__('Ma licence Masters'), 'user/licence')?></li> -->
		<? if ($isInscrit == true) { ?>
		    <li><a href="<?=url_for('tournament_slot/index')?>"><?=__('Gerer mon inscription')?></a></li>
		<? } 
		else { ?>
		    <li><a href="<?=url_for('tournament/index')?>"><?=__('Inscription a la Gamers Assembly')?></a></li>
		<? } ?>
            </ul>
            <br/>
            <b style="color: red;"><?=__('DOCUMENT(S) A IMPRIMER')?> :</b>
            <ul>
<!--                <li><a href="http://www.gamers-assembly.net/fr/bulletin" target="_blank"><?=__('Bulletin d inscription')?></a></li> -->
		<!--
                <li><a href="http://www.gamers-assembly.net/uploads/files/pdf/fiche_materiel.pdf" target="_blank">Fiche mat&eacute;riel</a></li>
		-->
                <li><a href="../../../../uploads/files/autorisation-parentale.pdf" target="_blank"><?=__('Autorisation parentale')?></a> <i>(<?=__('pour les joueurs mineurs')?>)</i></li>
            </ul>
        </td>
    </tr>
    </table>
    </div>
</div>
