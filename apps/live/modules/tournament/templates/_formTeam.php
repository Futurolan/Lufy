<? use_stylesheets_for_form($form) ?>
<? use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('tournament/addTeam') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<? if (!$form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
	<? endif; ?>

	<?=$form->renderHiddenFields(false) ?>
	<?=$form->renderGlobalErrors() ?>
	<?=__('Tournoi')?> <?=$form['tournament_id']->renderError() ?>
	<?=$form['tournament_id'] ?>

	<input type="submit" value="<?=__('Save')?>" />
</form>

<?=link_to('Retour', 'team/index');?>
