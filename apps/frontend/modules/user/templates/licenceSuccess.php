<div class="box">
    <h3>
        <?
        if ($user->getLicenceMasters()) :
            echo image_tag('/css/img/gamersassembly/icones/masters.png', array('title' => 'Licenci&eacute;', 'class' => 'licencelogo'));
        else :
            echo image_tag('/css/img/gamersassembly/icones/masters_nb.png', array('title' => 'Non licenci&eacute;', 'class' => 'licencelogo'));
        endif;
        ?>
        <?php echo __('Gestion de la licence Masters')?>
    </h3>
    <p>
        <?php echo __('Si vous ne possedez pas de licence Masters du Jeu Video vous devez créer un compte sur le site')?> 
        <a href="http://www.mastersjeuvideo.org" target="_blank">www.mastersjeuvideo.org</a>, <?php echo __('rendez-vous ensuite a la page')?> 
        <a href="http://www.mastersjeuvideo.org/license/" target="_blank">http://www.mastersjeuvideo.org/license/</a>.<br/>
        </p>
   <?if ($user->getLicenceMasters()) :?>
        <p><?php echo __('Votre licence Masters est')?> : <b><?php echo $user->getLicenceMasters();?></b></p>
        <p><?php echo __('Informations relatives a votre licence')?> :<br/>
        <?php echo __('Pseudo')?> : <?php echo $username;?><br/>
        <?php echo __('Saison')?> : <?php echo $season;?><br/>
        <?php echo __('Type de licence')?> : <?php echo $type;?><br/>
        </p>
    <?else :?>
        <p> 
            <?php echo __('Vous ne possedez pas de licence Masters, aucune reduction sera applique.')?><br/><br/>
            <a href="<?php echo  url_for('licence/masters'); ?>"><?php echo __('Ajouter une licence Masters')?></a><br />
            <a href="<?php echo  url_for('user/index'); ?>"><?php echo __('Retourner sur mon espace personnel')?></a>
        </p>
    <?endif;?>
</div>