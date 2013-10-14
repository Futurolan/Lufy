<h2>Statistiques > Actualit&eacute;s</h2>

<h3>Rythme de publication des actualit&eacute;s</h3>

<div id="chart" width="100%" height="400"></div>

<br/><br/>
<br/><br/>
<br/><br/>

<h3>Rythme de publication des commentaires</h3>

<div id="chartt" width="100%" height="400"></div>

<br/><br/>
<br/><br/>
<br/><br/>

<div style="float: left; width: 40%;">
  <h3>Repartition par langues</h3>
  <div id="chart2" width="100%" height="300"></div>
</div>

<div style="float: left; width: 60%;">
  <h3>Repartition par categories</h3>
  <div id="chart3" width="100%" height="300"></div>
</div>

<div style="clear: left;"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script>
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart()
{
  var data = google.visualization.arrayToDataTable(<?=json_encode($data)?>);

  var options = {
    height: 400,
    width: '100%',
    fontSize: 12,
    legend: 'none',
    vAxis: {
      title: 'Nombre de news publiees',
    },
    chartArea: {
      width: '85%',
      height: '75%',
    },
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart'));
  chart.draw(data, options);
}
</script>

<script>
google.setOnLoadCallback(drawChartt);

function drawChartt()
{
  var data = google.visualization.arrayToDataTable(<?=json_encode($dataa)?>);

  var options = {
    height: 400,
    width: '100%',
    fontSize: 12,
    legend: 'none',
    colors: ['#b82e2e'],
    vAxis: {
      title: 'Nombre de commentaires publies',
    },
    chartArea: {
      width: '85%',
      height: '75%',
    },
  };

  var chart = new google.visualization.LineChart(document.getElementById('chartt'));
  chart.draw(data, options);
}
</script>

<script>
google.setOnLoadCallback(drawChart2);

function drawChart2()
{
  var data = google.visualization.arrayToDataTable(<?=json_encode($data2)?>);

  var options = {
    height: 300,
    width: '40%',
    fontSize: 12,
    chartArea: {
      width: '85%',
      height: '80%',
    },
  };

  var chart2 = new google.visualization.PieChart(document.getElementById('chart2'));
  chart2.draw(data, options);
}
</script>

<script>
google.setOnLoadCallback(drawChart3);

function drawChart3()
{
  var data = google.visualization.arrayToDataTable(<?=json_encode($data3)?>);

  var options = {
    height: 300,
    width: '40%',
    fontSize: 12,
    chartArea: {
      width: '85%',
      height: '80%',
    },
  };

  var chart3 = new google.visualization.PieChart(document.getElementById('chart3'));
  chart3.draw(data, options);
}
</script>
