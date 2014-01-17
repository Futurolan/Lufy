<div class="box">
    <h2><?php echo __('Ajouter votre Ticket Weezevent')?></h2>
    <div class="flashbox info">
        <?php echo __('Pour lier un ticket Weezevent a votre compte GA vous devez renseigner correctement votre nom, prenom et date de naissance sur les deux site internet.')?>
    </div>
    <?php include_partial('formWeezevent', array('form' => $form)) ?>
</div>
