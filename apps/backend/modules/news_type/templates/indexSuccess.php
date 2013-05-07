<h2>Actualit&eacute;s > Configuration > Cat&eacute;gories</h2>

<?php echo ajax_link('Ajouter une cat&eacute;gorie', 'news_type/new', array('class' => 'button add'))?>
<?php echo ajax_link('Retour aux actualit&eacute;s', 'news/index', array('class' => 'button'))?>

<table class="table">
  <thead>
    <tr>
      <th></th>
      <th>Nom</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($news_types as $news_type): ?>
    <tr>
      <td><?php echo image_tag('/uploads/news/icones/'.$news_type->getLogourl())?></td>
      <td><a href="<?php echo url_for('news_type/edit?id_news_type='.$news_type->getIdNewsType())?>"><?php echo $news_type->getLabel()?></a></td>
      <td><?php echo $news_type->getDescription()?></td>
      <td><a class="button small" href="<?php echo url_for('news_type/edit?id_news_type='.$news_type->getIdNewsType())?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br />
