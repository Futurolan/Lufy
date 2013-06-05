<h2><?php echo __('Mes invitations')?></h2>

<?php include_partial('invitation', array('invites' => $invites )); ?>
<?php include_partial('history', array('invites' => $invites )); ?>

<style>
ul.invite {
  list-style-type: none;
  margin-left: 0px;
}
</style>
