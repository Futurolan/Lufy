<h2>Pages de contenu > Archives</h2>


<table class="table">
  <thead>
    <tr>
      <th>Titre</th>
      <th>Slug</th>
      <th>Cat&eacute;gorie</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pages as $page): ?>
    <tr>
      <td><?php echo $page->getTitle() ?></td>
      <td style="font-size: 10px;"><?php echo $page->getSlug() ?></td>
      <td style="font-size: 11px;"><?php echo $page->getPageType() ?></td>
      <td style="font-size: 11px;">
        <?php echo ajax_link('Supprimer', 'page/delete?id_page='.$page->getIdPage(), array('method' => 'delete', 'confirm' => 'Etes vous sur de vouloir supprimer la page ?')) ?> - 
        <?php echo ajax_link('D&eacute;sarchiver', 'page/unarchive?id_page='.$page->getIdPage(), array('method' => 'delete', 'confirm' => 'Etes vous sur de vouloir desarchiver la page ?')) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
