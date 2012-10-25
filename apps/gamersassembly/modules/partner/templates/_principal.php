<table>
    <tr>
    <?php foreach ($partners as $partner): ?>
        <td style="width: 300px;">
            <a href="<?= $partner->getWebsite() ?>" target="_blank">
                <?= image_tag('/uploads/partenaires/200/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="logo"') ?>
            </a>
        </td>
    <?php endforeach; ?>
