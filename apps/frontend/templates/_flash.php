<?php
$type = '';

if ($sf_user->isAuthenticated()):
  if ($sf_user->hasFlash('error')):
    $type = 'error';
  elseif ($sf_user->hasFlash('warning')):
    $type = 'warning';
  elseif ($sf_user->hasFlash('success')):
    $type = 'success';
  endif;
endif;
?>

<?php if ($type != ''): ?>
  <?php $content = $sf_user->getFlash($type); ?>
  <script>
    $('#content h2').after('<div class="alert alert-<?php echo $type; ?>"><?php echo $content; ?></div>');
  </script>
<?php endif; ?>


