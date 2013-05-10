<div class="box">
<?php echo form_tag('search/user') ?>
<?php echo $form->renderHiddenFields(false) ?>
<div class="title">Recherche d&acute;un joueur</div>
<div clas="content">
<div class="flashbox info">
    Vous pouvez rechercher un joueur en tapant une partie ou la totalit&eacute; de son pseudo. Vous devez utiliser 2 caractères au minimum.
</div>
<div>
	<?php echo $form['pattern']->renderError()?>
	<?php echo $form['pattern']->renderLabel()?>
	<?php echo $form['pattern']->render()?>
	<input type="submit" value="Ok" />
</div>
</div>
</form>
</div>
