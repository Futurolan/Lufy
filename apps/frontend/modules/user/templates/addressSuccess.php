<h2><?php echo __('Mes adresses')?></h2>

<?php foreach ($addresses as $address): ?>
  <address>
    <strong><?php echo $address->getName(); ?></strong>

    <?php if ($address->getIsDefault()): ?>
      <span class="label"><?php echo __('Defaut'); ?></span>
    <?php endif; ?>
    <?php if ($address->getIsBilling()): ?>
      <span class="label"><?php echo __('Facturation'); ?></span>
    <?php endif; ?>
    <?php if ($address->getIsDelivery()): ?>
      <span class="label"><?php echo __('Livraison'); ?></span>
    <?php endif; ?>
    <br/>

    <?php if ($address->getComplement()): ?>
      <?php echo $address->getComplement(); ?><br/>
    <?php endif; ?>
    <?php echo $address->getAddress(); ?><br/>
    <?php echo $address->getZipcode(); ?> <?php echo $address->getCity(); ?><br/>
    <?php echo $address->getCountry(); ?><br/>

    <?php echo link_to('<i class="icon-pencil"></i> Modifier', 'user/editAddress?id='.$address->getId(), array('class' => 'btn')); ?>
    <div class="btn-group">
      <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Definir comme <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><?php echo link_to(__('Adresse par defaut'), 'user/setDefaultAddress?id='.$address->getId()); ?></li>
        <li><?php echo link_to(__('Adresse de facturation'), 'user/setBillingAddress?id='.$address->getId()); ?></li>
        <li><?php echo link_to(__('Adresse de livraison'), 'user/setDeliveryAddress?id='.$address->getId()); ?></li>
      </ul>
    </div>
    <?php echo link_to('<i class="icon-remove"></i> Supprimer', 'user/deleteAddress?id='.$address->getId(), array('class' => 'btn')); ?> <br/>
  </address>
<?php endforeach;?>

<?php echo link_to('<i class="icon-plus"></i> '.__('Ajouter une adresse'), 'user/newAddress', array('class' => 'btn'))?>
