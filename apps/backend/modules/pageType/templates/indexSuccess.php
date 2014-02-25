<h2>Pages > Configuration > Cat&eacute;gories</h2>

<?=link_to('Ajouter une cat&eacute;gorie', 'pageType/new', array('class' => 'add btn btn-default'))?>
<?=link_to('Retour aux pages', 'page/index', array('class' => 'btn btn-default'))?>

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
      <td><a class="btn btn-default small" href="<?php echo url_for('pageType/edit?id_page_type='.$pageType->getIdPageType()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
