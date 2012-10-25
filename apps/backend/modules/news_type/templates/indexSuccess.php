<h2>Actualit&eacute;s > Configuration > Cat&eacute;gories</h2>

<?=ajax_link('Ajouter une cat&eacute;gorie', 'news_type/new', array('class' => 'button add'))?>
<?=ajax_link('Retour aux actualit&eacute;s', 'news/index', array('class' => 'button'))?>

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
    <? foreach ($news_types as $news_type): ?>
    <tr>
      <td><?=image_tag('/uploads/news/icones/'.$news_type->getLogourl())?></td>
      <td><a href="<?=url_for('news_type/edit?id_news_type='.$news_type->getIdNewsType())?>"><?=$news_type->getLabel()?></a></td>
      <td><?=$news_type->getDescription()?></td>
      <td><a class="button small" href="<?=url_for('news_type/edit?id_news_type='.$news_type->getIdNewsType())?>">Modifier</a></td>
    </tr>
    <? endforeach; ?>
  </tbody>
</table>
<br />
