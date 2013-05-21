<div class="box">
    <h3>
        <?
//        if ($licence->getSerial()) :
//            echo image_tag('/css/img/gamersassembly/icones/masters.png', array('title' => 'Licenci&eacute;', 'class' => 'licencelogo'));
//        else :
//            echo image_tag('/css/img/gamersassembly/icones/masters_nb.png', array('title' => 'Non licenci&eacute;', 'class' => 'licencelogo'));
//        endif;
//        ?>
        <?php echo __('Gestion de la licence Masters')?>
    </h3>
    <p>
        <?php echo __('Si vous ne possedez pas de licence Masters du Jeu Video vous devez créer un compte sur le site')?>
        <a href="http://www.mastersjeuvideo.org" target="_blank">www.mastersjeuvideo.org</a>, <?php echo __('rendez-vous ensuite a la page')?>
        <a href="http://www.mastersjeuvideo.org/license/" target="_blank">http://www.mastersjeuvideo.org/license/</a>.<br/>
        </p>
   <?php if ($licence->getSerial()): ?>
        <p><?php echo __('Votre licence Masters est')?> : <b><?php echo $licence->getSerial();?></b></p>
        <p><?php echo __('Informations relatives a votre licence')?> :<br/>
        <?php echo __('Pseudo')?> : <?php echo $licence->getUsername();?><br/>
        <?php echo __('Saison')?> : <?php echo $licence->getSeason();?><br/>
        </p>
    <?php else: ?>
        <?php include_partial('user/formLicenceMasters', array('form' => $form)); ?>
    <?php endif; ?>
</div>