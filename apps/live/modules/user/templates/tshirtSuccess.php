<div class="box">
  <div class="title"><?php echo __('Tshirt size')?></div>

  <div>
    <?php echo __('La taille du tee shirt est donnee a titre indicatif, nous ne pouvons pas garantir la diponibilitee sur place.')?>
  </div>
  <?php echo form_tag('@user_tshirt')?>
  <?php echo $form->renderHiddenFields()?>
    
    <table>
    	<?php echo $form['size']->renderRow()?>
    	<tr>
    		<td colspan="2" class="actions">
    		  <input type="submit" class="button" value="<?php echo __('Enregistrer')?>"/>
    		</td>
    	</tr>
    </table>
    
  </form>
</div>
