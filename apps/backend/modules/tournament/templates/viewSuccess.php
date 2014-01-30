<h2><?=$tournament->getName()?></h2>

<table class="table">
    <tr>
        <th>Tournois</th>
        <td><?=$tournament->getName()?></td>
        <th>Jeu</th>
        <td><?=$tournament->getGame()->getLabel()?></td>
    </tr>
    <tr>
        <th>Ev&egrave;nement</th>
        <td><?=$tournament->getEvent()->getName()?></td>
        <th>Plateforme</th>
        <td><?=$tournament->getGame()->getPlateform()->getName()?></td>
    </tr>
    <tr>
        <th>Nb joueurs</th>
        <td><?=$tournament->getNumberTeam()*$tournament->getPlayerPerTeam()?></td>
        <th>Nb &eacute;quipes</th>
        <td><?=$tournament->getNumberTeam()?></td>
    </tr>
    <tr>
        <th>Nb slots r&eacute;serv&eacute;s</th>
        <td><?=$tournament->getReservedSlot()?></td>
        <th>Prix</th>
        <td><?=$tournament->getCostPerPlayer()?></td>
    </tr>
    <tr>
        <th>Identifiant Weezevent</th>
        <td><?=$tournament->getWeezeventId()?></td>
    </tr>
    <tr>
        <th>Description</th>
        <td colspan="3"><?=$tournament->getDescription()?></td>
    </tr>
</table>

<a href="<?php echo url_for('tournament/edit?id_tournament='.$tournament->getIdTournament()) ?>" class="button">Modifier</a>
<br/><br/><br/>

<h3>Etat du tournois</h3>
<?
$state_reserve = 0;
$state_valide = 0;
$state_inscrit = 0;
$state_libre = 0;
$state_total = 0;
$state_max_slot = $tournament->getNumberTeam();
?>


    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://cdn.kendostatic.com/2012.2.913/js/kendo.all.min.js"></script>
    <link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.common.min.css" rel="stylesheet" />
    <link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.default.min.css" rel="stylesheet" />
    <link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.dataviz.min.css" rel="stylesheet" />

<div id="example" class="k-content">
            <div class="chart-wrapper">
                <div id="chart"></div>
            </div>
            <script>
                function createChart() {
                    $("#chart").kendoChart({
                        theme: $(document).data("kendoSkin") || "default",
                        legend: {
                            position: "right",
                            labels: {
                                template: "#= text # (#= value #%)"
                            }
                        },
                        seriesDefaults: {
                            labels: {
                                visible: true,
                                position: "outsideEnd",
                                format: "{0}%"
                            }
                        },
                        series: [{
                            type: "donut",
                            data: [{
                                category: "<?=$state_reserve?> reserv&eacute;s",
                                value: <?=$percent_reserve?>
                            }, {
                                category: "<?=$state_valide-$state_reserve?> valid&eacute;s",
                                value: <?=$percent_valide?>
                            }, {
                                category: "<?=$state_inscrit-$state_reserve-$state_valide?> en attente",
                                value: <?=$percent_inscrit?>
                            }, {
                                category: "<?=$state_libre?> libres",
                                value: <?=$percent_libre?>
                            }]
                        }],
                        tooltip: {
                            visible: true,
                            format: "{0}%"
                        }
                    });
                }

                $(document).ready(function() {
                    setTimeout(function() {
                        // Initialize the chart with a delay to make sure
                        // the initial animation is visible
                        createChart();

                        $("#example").bind("kendo:skinChange", function(e) {
                            createChart();
                        });
                    }, 400);
                });
            </script>
        </div>

<br/><br/>
<h3>Administrateurs du tournois</h3>
<table class="table">
    <tr>
        <th>Utilisateur</th>
       <!-- <th>Nom</th>
        <th>Pr&eacute;nom</th>-->
        <th>Actions</th>
    </tr>
<?php
$i=0;
foreach ($admins as $admin):
?>
    <tr>
        <td><?=$admin->getUsername($admin->getUserId())?></td>
        <!--<td><?//=$admin->getLastName($admin->getUserId())?></td>
        <td><?//=$admin->getSfGuardUser()->getFirstName()?></td>-->
        <td><a href="<?php echo url_for('tournament_admin/delete?user_id='.$admin->getIdTournamentAdmin()) ?>">Supprimer</a></td>
    </tr>
<?php
endforeach;
?>
    <tr>
        <td colspan="4" align="center"><i><a href="<?php echo url_for('tournament_admin/new') ?>">Ajouter un administrateur</a> sur le tournois</i></td>
</table>
