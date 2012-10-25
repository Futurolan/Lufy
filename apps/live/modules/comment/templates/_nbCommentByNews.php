<?php
$n = $nb_comments;

if ($n == 0):
  echo 'Aucun commentaire';
elseif ($n == 1):
  echo $n.' commentaire';
else:
  echo $n.' commentaires';
endif;

?>
