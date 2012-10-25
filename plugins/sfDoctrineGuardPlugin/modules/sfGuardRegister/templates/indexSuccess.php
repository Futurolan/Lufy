<?php use_helper('I18N') ?>
<div class="box">
    <div class="title">Cr&eacute;er un compte</div>
    <div class="content">
        <p class="flashbox info">Apr&eacute;s la cr&eacute;ation de votre compte vous devrez proc&eacute;der &agrave; la confirmation de votre adresse mail, un message contenant un lien de v&eacute;rification vous sera envoy&eacute;. 
        Vous aurez ensuite la possibilit&eacute; de vous inscrire &agrave; un tournoi et de consulter les &eacute;quipes et les profils des autres joueurs.</p>
        <?php echo get_partial('sfGuardRegister/form', array('form' => $form)) ?>
    </div>
</div>
