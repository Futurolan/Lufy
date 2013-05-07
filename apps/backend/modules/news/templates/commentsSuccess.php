<h2>Actualit&eacute;s > <?php echo $news->getTitle()?> > Commentaires</h2>

<?php foreach ($comments as $comment): ?>
  <div style="border-bottom: solid 1px #aaa;">
    <p>
      <?php echo $comment->getContent()?>
    </p>
    <i style="font-size: 11px; color:#666;" id="coment_status_<?php echo $comment->getIdComment()?>">
      <?php if ($comment->getStatus() == 1): ?>
          <?php $img = '/css/img/backend/8green.png'; ?>
        <?php else: ?>
          <?php $img = '/css/img/backend/8red.png'; ?>
        <?php endif; ?>
        <?php echo ajax_component(image_tag($img), 'comment/switchStatus?id_comment='.$comment->getIdComment())?>
      <i>
        Publi&eacute; par <?php echo link_to($comment->getSfGuardUser()->getUsername(), 'sfGuardUser/edit?id='.$comment->getSfGuardUser()->getId(), array('target' => '_blank'))?> le <?php echo date('d/m/Y', strtotime($comment->getCreatedAt()))?> - 
        <?php echo ajax_component('Supprimer', 'comment/delete?id_comment='.$comment->getIdComment())?>
      </i>
    </p>
  </div>
<?php endforeach; ?>
