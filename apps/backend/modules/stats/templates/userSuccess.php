<h2>Statistiques > Utilisateurs</h2>

<h3>Repartition des utilisateurs par date de naissance</h3>

<div id="chart"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script>
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart()
{
  var data = google.visualization.arrayToDataTable(<?=json_encode($data)?>);

  var options = {
    height: 600,
    width: '100%',
    fontSize: 12,
    legend: 'none',
    vAxis: {
      title: 'Age des utilisateurs',
    },
    hAxis: {
      minValue: 10,
      maxValue: 60,
    },
    chartArea: {
      width: '85%',
      height: '85%',
    },
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart'));
  chart.draw(data, options);
}
</script>
