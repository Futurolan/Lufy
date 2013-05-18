<h2><?php echo __('Tshirt size')?></h2>

<div class="alert alert-info">
  <?php echo __('La taille du tee shirt est donnee a titre indicatif, nous ne pouvons pas garantir la diponibilitee sur place.')?>
</div>

<?php echo form_tag('@user_tshirt')?>
<?php echo $form->renderHiddenFields()?>

<table>
  <?php echo $form['size']->renderRow()?>
  <tr>
    <td colspan="2" class="actions">
      <input type="submit" class="btn" value="<?php echo __('Valider')?>"/>
    </td>
  </tr>
</table>

</form>
