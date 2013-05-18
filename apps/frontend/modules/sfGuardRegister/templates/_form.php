<form action="<?php echo url_for('@sf_guard_register') ?>" method="post">
  <table>
    <?php echo $form ?>
    <tfoot>
      <tr>
        <td colspan="2">
          <input class="btn" type="submit" name="register" value="<?php echo __('Register', null, 'sf_guard') ?>" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
