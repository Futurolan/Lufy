<h2>Pages > Configuration > Cat&eacute;gories</h2>

<?php echo ajax_link('Ajouter une cat&eacute;gorie', 'pageType/new', array('class' => 'add button'))?>
<?php echo ajax_link('Retour aux pages', 'page/index', array('class' => 'button'))?>

<table class="table">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pageTypes as $pageType): ?>
    <tr>
      <td><a href="<?php echo url_for('pageType/edit?id_page_type='.$pageType->getIdPageType()) ?>"><?php echo $pageType->getLabel() ?></a></td>
      <td><?php echo $pageType->getDescription() ?></td>
      <td><a class="button small" href="<?php echo url_for('pageType/edit?id_page_type='.$pageType->getIdPageType()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
