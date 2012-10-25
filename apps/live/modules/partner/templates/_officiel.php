        <? foreach ($partners as $partner): ?>
        <td style="width: 150px;">
            <a href="<?= $partner->getWebsite() ?>">
                <?=image_tag('/uploads/partenaires/100/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="partnerLogo"')?>
            </a>
        </td>
        <? endforeach; ?>
    </tr>
</table>