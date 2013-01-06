<table>
    <tbody>
        <?php foreach ($nexttournaments as $tournament): ?>    
            <tr>
                <td>
                <?= image_tag('/uploads/jeux/icones/' . $tournament->getImage(), 'alt="' . $tournament->getName() . '"') ?>
            </td>
            <td>
                <?= link_to($tournament->getName(), 'poker_tournament/view?slug=' . $tournament->getSlug()) ?><br /><i><?= $tournament->getNumberSlot() ?> participants</i>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>