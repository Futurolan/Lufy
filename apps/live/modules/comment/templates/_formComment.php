<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
Ajouter un commentaire
<form action="" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

    <input type="hidden" name="sf_method" value="put" />


    <?php echo  $form->renderHiddenFields(false) ?>
    <?php echo  $form->renderGlobalErrors() ?>
    <?php echo  $form['content']->renderError() ?>
    <?php echo  $form['content'] ?>

    <input type="submit" value="Ajouter le commentaire" class="button"/>
</form>
<br/><br/>

