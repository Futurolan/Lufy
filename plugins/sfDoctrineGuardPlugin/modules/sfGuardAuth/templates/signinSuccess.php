<?php use_helper('I18N') ?>
<div class="box">
    <div class="title">Se connecter</div>
    <div class="content">
        <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
    </div>
</div>
