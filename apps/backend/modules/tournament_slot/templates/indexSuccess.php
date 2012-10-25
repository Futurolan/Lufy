<h2>Tournois > <?= $lastevent[0]->getName() ?></h2>

<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Nombre de Slots</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=0;
        foreach ($tournaments as $tournament):
        $i++;
        ?>
            <tr>
                <td><?=image_tag('/uploads/jeux/icones/'.$tournament->getLogourl())?> <a href="<?php echo url_for('tournament/view?slug=' . $tournament->getSlug()) ?>"><?php echo $tournament->getName() ?></a></td>
                <td><?php echo $tournament->getNumberTeam() ?></td>
                <td><a href="<?php echo url_for('tournament_slot/tournament?slug=' . $tournament->getSlug()) ?>">Voir les slots</a> - <a href="<?= url_for('tournament_slot/updatePosition?slug=' . $tournament->getSlug()) ?>">Ranger les slots</a></td>
            </tr>
        <?php
        endforeach;
        if ($i==0):
        ?>
            <tr>
                <td colspan="3" align="center"><i>Aucun tournois sur cet &eacute;v&egrave;nement pour l'instant. <a href="<?php echo url_for('tournament/index'); ?>">Ajouter des tournois</a></i></td>
            </tr>
        <?php
        endif;
        ?>
        </tbody>
    </table>
    <a href="<?php echo url_for('tournament/new') ?>" class="button">Ajouter un tournois</a>
    <a href="<?php echo url_for('tournament/index') ?>" class="button">Voir tous les tournois</a>
</table>
