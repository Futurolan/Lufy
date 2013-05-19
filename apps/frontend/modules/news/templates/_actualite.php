<ul style="list-style: none; margin-left: 0px;">
<?php foreach ($actualites as $actualite): ?>
  <li style="line-height: 25px;" class="news-list">
    <span class="label label-info"><?php echo format_date($actualite->getPublishOn(), 'dd/MM')?></span>
    &nbsp;
    <?php echo link_to($actualite->getTitle(), 'news/view?slug='.$actualite->getSlug()) ?>
  </li>
<?php endforeach; ?>
</ul>

<?php echo link_to(__('Plus d\'actualites'), 'news/index', array('class' => 'btn btn-small pull-right'))?>
