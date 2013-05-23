<h2>Actualit&eacute;s > <?=$news->getTitle()?> > Commentaires</h2>

<? foreach ($comments as $comment): ?>
  <div style="border-bottom: solid 1px #aaa;">
    <p>
      <?=$comment->getContent()?>
    </p>
    <p style="font-size: 11px; color:#666;" id="coment_status_<?=$comment->getIdComment()?>">
      <? if ($comment->getStatus() == 1): ?>
          <? $img = '/css/img/backend/8green.png'; ?>
        <? else: ?>
          <? $img = '/css/img/backend/8red.png'; ?>
        <? endif; ?>
        <?=ajax_component(image_tag($img), 'comment/switchStatus?id_comment='.$comment->getIdComment())?>
      <i>
        Publi&eacute; par <?=link_to($comment->getSfGuardUser()->getUsername(), 'sfGuardUser/edit?id='.$comment->getSfGuardUser()->getId(), array('target' => '_blank'))?> le <?=date('d/m/Y', strtotime($comment->getCreatedAt()))?> - 
        <?=ajax_component('Supprimer', 'comment/delete?id_comment='.$comment->getIdComment())?>
      </i>
    </p>
  </div>
<? endforeach; ?>
