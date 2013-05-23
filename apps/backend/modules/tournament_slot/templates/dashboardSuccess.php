<meta http-equiv="refresh" content="30">
<h2>Tableau de bord > &Eacute;tat des tournois</h2>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://cdn.kendostatic.com/2012.2.913/js/kendo.all.min.js"></script>
    <link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.common.min.css" rel="stylesheet" />
    <link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.default.min.css" rel="stylesheet" />
    <link href="http://cdn.kendostatic.com/2012.2.913/styles/kendo.dataviz.min.css" rel="stylesheet" />

<? $i = 0; ?>
<? foreach ($tournaments as $tournament): ?>

<?
$state_reserve = 0;
$state_valide = 0;
$state_inscrit = 0;
$state_libre = 0;
$state_total = 0;
$state_max_slot = $tournament->getNumberTeam();
?>
<? foreach ($tournament->getTournamentSlot() as $slot): 
    if ($slot->getStatus() == 'reserve'):
      $state_reserve++;
      $state_valide++;
      $state_inscrit++;
    elseif ($slot->getStatus() == 'valide'):
      $state_valide++;
      $state_inscrit++;
    elseif ($slot->getStatus() == 'inscrit'):
      $state_inscrit++;
    elseif ($slot->getStatus() == 'attente'):
      $state_inscrit++;
    elseif ($slot->getStatus() == 'libre'):
      $state_libre++;
    endif;
    $state_total++;
endforeach; ?>

<?php
// Calcul des pourcentages
$percent_libre = round($state_libre*100/$state_max_slot);
$percent_inscrit = round(($state_inscrit-$state_valide-$state_reserve)*100/$state_max_slot);
if ($percent_inscrit < 0) { $percent_inscrit = 0; }
$percent_valide = round(($state_valide-$state_reserve)*100/$state_max_slot);
$percent_reserve = round($state_reserve*100/$state_max_slot);

$i++;
?>
<div style="width: 24%; float: left; margin-left: 10px;">
    <div id="example<?=$i?>" class="k-content">
            <div class="chart-wrapper">
                <div id="chart<?=$i?>"></div>
            </div>
            <script>
                function createChart<?=$i?>() {
                    $("#chart<?=$i?>").kendoChart({
                        theme: $(document).data("kendoSkin") || "blueopal",
                        title: {
                            text: "<?=$tournament->getName()?>"
                        },
                        legend: {
                            position: "bottom",
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
                                category: "<?=$state_libre?> libres",
                                value: <?=$percent_libre?>
                            }, {
                                category: "<?=($state_inscrit-$state_reserve-$state_valide)<0?0:($state_inscrit-$state_reserve-$state_valide) ?> en attente",
                                value: <?=$percent_inscrit?>
                            }]
                        }],
                        tooltip: {
                            visible: true,
                            format: "{0}%",
                            template: "#= category #",
                        }
                    });
                }

                $(document).ready(function() {
                    setTimeout(function() {
                        // Initialize the chart with a delay to make sure
                        // the initial animation is visible
                        createChart<?=$i?>();

                        $("#example<?=$i?>").bind("kendo:skinChange", function(e) {
                            createChart<?=$i?>();
                        });
                    }, 400);
                });
            </script>
        </div>
</div>
<? endforeach; ?>
<div style="clear: left;"></div>
