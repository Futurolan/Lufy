<div class="box">
    <h3>
        <?
        if ($user->getLicenceMasters()) :
            echo image_tag('/css/img/gamersassembly/icones/masters.png', array('title' => 'Licenci&eacute;', 'class' => 'licencelogo'));
        else :
            echo image_tag('/css/img/gamersassembly/icones/masters_nb.png', array('title' => 'Non licenci&eacute;', 'class' => 'licencelogo'));
        endif;
        ?>
        <?=__('Gestion de la licence Masters')?>
    </h3>
    <p>
        <?=__('Si vous ne possedez pas de licence Masters du Jeu Video vous devez créer un compte sur le site')?> 
        <a href="http://www.mastersjeuvideo.org" target="_blank">www.mastersjeuvideo.org</a>, <?=__('rendez-vous ensuite a la page')?> 
        <a href="http://www.mastersjeuvideo.org/license/" target="_blank">http://www.mastersjeuvideo.org/license/</a>.<br/>
        </p>
   <?if ($user->getLicenceMasters()) :?>
        <p><?=__('Votre licence Masters est')?> : <b><?=$user->getLicenceMasters();?></b></p>
        <p><?=__('Informations relatives a votre licence')?> :<br/>
        <?=__('Pseudo')?> : <?=$username;?><br/>
        <?=__('Saison')?> : <?=$season;?><br/>
        <?=__('Type de licence')?> : <?=$type;?><br/>
        </p>
    <?else :?>
        <p> 
            <?=__('Vous ne possedez pas de licence Masters, aucune reduction sera applique.')?><br/><br/>
            <a href="<?= url_for('licence/masters'); ?>"><?=__('Ajouter une licence Masters')?></a><br />
            <a href="<?= url_for('user/index'); ?>"><?=__('Retourner sur mon espace personnel')?></a>
        </p>
    <?endif;?>
</div>