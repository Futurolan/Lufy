<?
$type = '';

if ($sf_user->hasFlash('error')):
  $type = 'danger';
elseif ($sf_user->hasFlash('warning')):
  $type = 'warning';
elseif ($sf_user->hasFlash('success')):
  $type = 'success';
endif;
?>

<? if ($type != ''): ?>
  <? if ($type == 'danger') { $flash_type = 'error'; } else { $flash_type = $type; }?>
  <? $content = $sf_user->getFlash($flash_type); ?>
  <script>
    $(document).ready(function() {
      $('.subbreadcrumb').after('<div class="alert alert-<?php echo $type; ?>"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $content; ?></div>');
    });
  </script>
<? endif; ?>
