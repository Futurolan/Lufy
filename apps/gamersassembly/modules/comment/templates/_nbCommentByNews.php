<?php
$n = $nb_comments;

if ($n == 0):
  echo __('Aucun commentaire');
elseif ($n == 1):
  echo $n.' '.__('commentaire');
else:
  echo $n.' '.__('commentaires');
endif;

?>
