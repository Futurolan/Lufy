<table>
    <tr>
    <?php foreach ($partners as $partner): ?>
        <td style="width: 300px;">
            <a href="<?php echo  $partner->getWebsite() ?>" target="_blank">
                <?php echo  image_tag('/uploads/partenaires/200/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="logo"') ?>
            </a>
        </td>
    <?php endforeach; ?>
