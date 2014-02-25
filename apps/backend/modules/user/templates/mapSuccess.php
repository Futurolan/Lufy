<style>
#map {
	width:100%;
	margin:0 auto;
	height:1100px;
}
</style>


<div id="map"></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://www.pittss.lv/jquery/gomap/js/jquery.gomap-1.3.2.min.js"></script>
<script>
$(function() {
    $("#map").goMap({
        address: 'France',
        zoom: 6,
        maptype: 'ROADMAP',
        markers:
<?=file_get_contents('http://www.futurolan.net/joueur_valide.json-map.php?key=fdqjklfqclfqgcqc7894JH23cbn2jCBL132490SRJN23NDS')?>
        ,
        icon: 'http://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/16/Map-Marker-Marker-Outside-Azure.png'
    });
});
</script>
