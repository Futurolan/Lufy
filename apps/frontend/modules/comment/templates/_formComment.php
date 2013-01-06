<? use_stylesheets_for_form($form) ?>
<? use_javascripts_for_form($form) ?>
<div class="subtitle">Ajouter un commentaire</div>
<form action="" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

    <input type="hidden" name="sf_method" value="put" />


    <?= $form->renderHiddenFields(false) ?>
    <?= $form->renderGlobalErrors() ?>
    <?= $form['content']->renderError() ?>
    <?= $form['content'] ?>

    <input type="submit" value="Ajouter le commentaire" class="button"/>
</form>
<br/><br/>

