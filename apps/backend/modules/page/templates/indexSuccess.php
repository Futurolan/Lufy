<h2>Pages</h2>

<?=link_to('Ajouter une page', 'page/new', array('class' => 'btn btn-default add'))?>
<?=link_to('Voir les pages archiv&eacute;es', 'page/archived', array('class' => 'btn btn-default'))?> 
<?=link_to('Gerer les cat&eacute;gories', 'pageType/index', array('class' => 'btn btn-default'))?> 


<table class="table">
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th>Titre</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pages as $page): ?>
    <? if (substr($page->getSlug(), -3, 3) != '-en'): ?>
    <tr>
      <td><? if ($page->getStatus() == 1): echo image_tag('/css/img/backend/8green.png'); else: echo image_tag('/css/img/backend/8red.png'); endif;?>
      <td>
          <?php echo link_to(image_tag('/css/img/flag/FR.png'), 'page/edit?slug='.$page->getSlug()) ?><br style="margin: 5px;"/>
          <?php echo link_to(image_tag('/css/img/flag/GB.png'), 'page/edit?slug='.$page->getSlug().'-en') ?> 
      </td>
      <td>
          <?php echo link_to($page->getPageType().' &gt; '.$page->getTitle(), 'page/edit?slug='.$page->getSlug()) ?><br/>
      <i style="color: #666;font-size: 10px;"><?php echo $page->getSlug() ?></i>
      </td>
      <td style="font-size: 11px;">
        <a class="btn btn-default small left" href="http://www.gamers-assembly.net/fr/page/<?=$page->getSlug()?>" target="_blank">Apercu</a>
        <!-- <?php echo link_to('Modifier', 'page/edit?slug='.$page->getSlug()) ?> -->
        <?php echo link_to('Dupliquer', 'page/duplicate?id_page='.$page->getIdPage(), array('class' => 'btn btn-default small middle', 'confirm' => 'La page va etre dupliqu&eacute;. Continuer ?')) ?>
        <?php echo link_to('Supprimer', 'page/delete?id_page='.$page->getIdPage(), array('class' => 'btn btn-default small middle', 'method' => 'delete', 'confirm' => 'Etes vous sur de vouloir supprimer la page ?')) ?>
        <?php echo link_to('Archiver', 'page/archive?id_page='.$page->getIdPage(), array('class' => 'btn btn-default small right', 'method' => 'delete', 'confirm' => 'Etes vous sur de vouloir archiver la page ?')) ?>
      </td>
    </tr>
    <? endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>
