<div class="box">
    <div class="title"><?php echo __('Forgot your password?') ?></div>
    <div class="content">
<p>
  <?php echo __('Do not worry, we can help you get back in to your account safely!') ?>
  <?php echo __('Fill out the form below to request an e-mail with information on how to reset your password.') ?>
</p>

<form action="<?php echo url_for('@sf_guard_forgot_password') ?>" method="post">
  <table>
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot><tr><td><input class="button" type="submit" name="change" value="<?php echo __('Request') ?>" /></td></tr></tfoot>
  </table>
</form>
    </div>
</div>
