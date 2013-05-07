<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('tournament/addTeam') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<?php if (!$form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>

	<?php echo $form->renderHiddenFields(false) ?>
	<?php echo $form->renderGlobalErrors() ?>
	<?php echo __('Tournoi')?> <?php echo $form['tournament_id']->renderError() ?>
	<?php echo $form['tournament_id'] ?>

	<input type="submit" value="<?php echo __('Save')?>" />
</form>

<?php echo link_to('Retour', 'team/index');?>
