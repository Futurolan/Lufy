<h2>Liste des Variables de configuration</h2>

<table class="table">
    <thead>
        <tr>            
            <th>Nom</th>
            <th>Valeur</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($var_configs as $var_config): ?>
            <tr>
                <td><?php echo $var_config->getName() ?></td>
                <td><?php echo $var_config->getValue() ?></td>
                <td><?php echo $var_config->getDescription() ?></td>
                <td><a href="<?php echo url_for('var_config/edit?id_var=' . $var_config->getIdVar()) ?>">modifier</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br/><br/><br/>
<a href="<?php echo url_for('var_config/new') ?>" class="btn btn-default">Nouvelle variable de configuration</a>

