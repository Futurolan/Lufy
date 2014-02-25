<h2>Galeries</h2>

<table class="table">
  <thead>
    <tr>
      <th></th>
      <th>Name</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($file_categorys as $file_category): ?>
    <tr>
      <td id="fileCategory_status_<?=$file_category->getIdFileCategory()?>">
        <? if ($file_category->getStatus() == 1): ?>
          <? $img = '/css/img/backend/8green.png'; ?>
        <? else: ?>
          <? $img = '/css/img/backend/8red.png'; ?>
        <? endif; ?>
        <a style="cursor: pointer;" onclick="fileCategory_switchStatus('<?=$file_category->getIdFileCategory()?>');"><?=image_tag($img)?></a>
      </td>
      <td>
        <a href="<?php echo url_for('file/list?file_category='.$file_category->getIdFileCategory()) ?>"><?php echo $file_category->getName() ?></a><br/>
        <i style="font-size: 11px; color:#666;"><?=$file_category['nb_file']?> &eacute;l&eacute;ments</i> 
      </td>
      <td><?php echo $file_category->getDescription() ?></td>
      <td><a href="<?php echo url_for('file_category/edit?id_file_category='.$file_category->getIdFileCategory()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-default" href="<?php echo url_for('file_category/new') ?>">Nouveau</a>

<script>
function fileCategory_switchStatus(id) {
  $.get('<?=url_for('file_category/switchStatus')?>',
    { 'id_file_category': id },
    function success(data) {
      if ($('#fileCategory_status_'+id+' a img').attr('src') == '/css/img/backend/8green.png') {
        $('#fileCategory_status_'+id+' a img').attr('src', '/css/img/backend/8red.png');
      }
      else {
        $('#fileCategory_status_'+id+' a img').attr('src', '/css/img/backend/8green.png');
      }
    });
}
</script>
