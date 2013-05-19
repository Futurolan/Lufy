<h2>Recherche d&acute;un joueur</h2>

<div class="alert alert-info">
    Vous pouvez rechercher un joueur en tapant une partie ou la totalit&eacute; de son pseudo. Vous devez utiliser 2 caractères au minimum.
</div>

<form action="<?php echo url_for('search/user'); ?>" method="GET">
  <div class="input-append">
    <input type="text" name="byUsername" />
    <button class="btn" type="submit">Go!</button>
  </div>
</form>

<?php if ($sf_request->getParameter('byUsername')): ?>
  <h3>R&eacute;sulats de la recherche</h3>
  <?php if (count($users) == 0): ?>
    <div class="alert alert-warning">Aucun resultat</div>
  <?php else: ?>
    <ul>
    <?php foreach ($users as $user): ?>
      <li><?php echo link_to($user->getUsername(), 'user/view?username='.$user->getUsername()); ?></li>
    <?php endforeach; ?>
    </ul>
  <?php endif; ?>
<?php endif; ?>
