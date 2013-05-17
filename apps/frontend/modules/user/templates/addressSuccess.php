<div class="box">
    <div class="title"><?php echo __('Vos adresses')?></div>
    <div class="content">
    <li><?php echo link_to(__('Ajouter une adresse'), 'user/newAddress')?></li>
    <?php foreach ($addresses as $address) { ?>
    <div>
      <?php echo $address->getName();?>
      <span class="button"><?php echo link_to('Modifier', 'user/editAddress?id='.$address->getId()); ?> </span>
      <span class="button"><?php echo link_to('Supprimer', 'user/deleteAddress?id='.$address->getId()); ?> </span> <br/>
    </div>
    <?php }?>
    </div>
</div>
