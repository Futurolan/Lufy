<div class="box">
  <div class="title"><?php echo __('Changer le mot de passe')?></div>
  
  <?php echo form_tag('@user_password')?>
  <?php echo $form->renderHiddenFields()?>
    
    <table>
    	<?php echo $form['old_password']->renderRow()?>
    	<?php echo $form['password']->renderRow()?>
    	<?php echo $form['password_again']->renderRow()?>
    	<tr>
    		<td colspan="2" class="actions">
    		  <input type="submit" value="<?php echo __('Modifier')?>"/>
    		</td>
    	</tr>
    </table>
    
  </form>
</div>
