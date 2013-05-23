<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('friend/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?user_id='.$form->getObject()->getUserId().'&friend_id='.$form->getObject()->getFriendId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('friend/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Delete', 'friend/delete?user_id='.$form->getObject()->getUserId().'&friend_id='.$form->getObject()->getFriendId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
    </tbody>
  </table>
</form>
