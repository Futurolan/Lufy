        <?php foreach ($partners as $partner): ?>
        <td style="width: 150px;">
            <a href="<?php echo  $partner->getWebsite() ?>">
                <?php echo image_tag('/uploads/partenaires/100/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="partnerLogo"')?>
            </a>
        </td>
        <?php endforeach; ?>
    </tr>
</table>