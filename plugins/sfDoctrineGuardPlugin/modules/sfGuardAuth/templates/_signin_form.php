<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
<?=$form->renderHiddenFields()?>
<?=$form['username']->renderError()?>
  <table>
    <tr>
        <th>Nom d'utilisateur</th>
      <td><?=$form['username']?></td>
    </tr>
    <tr>
        <th>Mot de passe</th>
        <td><?=$form['password']?></td>
    </tr>
    <tr>
        <td colspan="2"><?=$form['remember']?> Rester connect&eacute;</td>
    </tr>
    </table>
    <br />

          <input class="button" type="submit" value="<?php echo __('S\'identifier') ?>" />

          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            <a class="button" href="<?php echo url_for('@sf_guard_forgot_password') ?>">Mot de passe perdu ?</a>
          <?php endif; ?>

          <?php if (isset($routes['sf_guard_register'])): ?>
            <a class="button" href="<?php echo url_for('@sf_guard_register') ?>">Cr&eacute;er un compte !</a>
          <?php endif; ?>

</form>
