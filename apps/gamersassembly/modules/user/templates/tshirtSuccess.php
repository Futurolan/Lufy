<div class="box">
  <div class="title"><?=__('Tshirt size')?></div>

  <div>
    <?=__('La taille du tee shirt est donnee a titre indicatif, nous ne pouvons pas garantir la diponibilitee sur place.')?>
  </div>
  <?=form_tag('@user_tshirt')?>
  <?=$form->renderHiddenFields()?>
    
    <table>
    	<?=$form['size']->renderRow()?>
    	<tr>
    		<td colspan="2" class="actions">
    		  <input type="submit" class="button" value="<?=__('Enregistrer')?>"/>
    		</td>
    	</tr>
    </table>
    
  </form>
</div>
