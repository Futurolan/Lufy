<h2>Pages</h2>

<?=ajax_link('Ajouter une page', 'page/new', array('class' => 'button add'))?>
<?=ajax_link('Voir les pages archiv&eacute;es', 'page/archived', array('class' => 'button'))?> 
<?=ajax_link('Gerer les cat&eacute;gories', 'pageType/index', array('class' => 'button'))?> 


<table class="table">
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th>Titre</th>
      <th>Cat&eacute;gorie</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pages as $page): ?>
    <? if (substr($page->getSlug(), -3, 3) != '-en'): ?>
    <tr>
      <td><? if ($page->getStatus() == 1): echo image_tag('/css/img/backend/8green.png'); else: echo image_tag('/css/img/backend/8red.png'); endif;?>
      <td>
          <?php echo ajax_link(image_tag('/css/img/flag/FR.png'), 'page/edit?slug='.$page->getSlug()) ?><br style="margin: 5px;"/>
          <?php echo ajax_link(image_tag('/css/img/flag/GB.png'), 'page/edit?slug='.$page->getSlug().'-en') ?> 
      </td>
      <td>
          <?php echo ajax_link($page->getTitle(), 'page/edit?slug='.$page->getSlug()) ?><br/>
      <i style="color: #666;font-size: 10px;"><?php echo $page->getSlug() ?></i>
      </td>
      <td style="font-size: 11px;"><?php echo $page->getPageType() ?></td>
      <td style="font-size: 11px;">
        <a class="button small left" href="http://www.gamers-assembly.net/fr/page/<?=$page->getSlug()?>" target="_blank">Apercu</a>
        <!-- <?php echo ajax_link('Modifier', 'page/edit?slug='.$page->getSlug()) ?> -->
        <?php echo ajax_link('Dupliquer', 'page/duplicate?id_page='.$page->getIdPage(), array('class' => 'button small middle', 'confirm' => 'La page va etre dupliqu&eacute;. Continuer ?')) ?>
        <?php echo ajax_link('Supprimer', 'page/delete?id_page='.$page->getIdPage(), array('class' => 'button small middle', 'method' => 'delete', 'confirm' => 'Etes vous sur de vouloir supprimer la page ?')) ?>
        <?php echo ajax_link('Archiver', 'page/archive?id_page='.$page->getIdPage(), array('class' => 'button small right', 'method' => 'delete', 'confirm' => 'Etes vous sur de vouloir archiver la page ?')) ?>
      </td>
    </tr>
    <? endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>
