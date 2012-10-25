<span onmouseover="showTournament('Troph&eacute;e MEDION Starcraft 2');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/sc2.png', 'alt="SC2"') ?></span>
<span onmouseover="showTournament('Troph&eacute;e MSI NVIDIA League of Legends');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/lol.png', 'alt="LoL"') ?></span>
<span onmouseover="showTournament('Coupe de France Battlefield 3');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/bf3.png', 'alt="BF3"') ?></span>
<span onmouseover="showTournament('Call of Duty Modern Warfare 3');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/CODMW3.png', 'alt="CODMW3"') ?></span>
<span onmouseover="showTournament('Call of Duty 4');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/cod4.png', 'alt="COD4"') ?></span>
<span onmouseover="showTournament('Team Fortress 2');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/tf2.png', 'alt="TF2"') ?></span>
<span onmouseover="showTournament('Counter Strike Source');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/css.png', 'alt="CSS"') ?></span>
<span onmouseover="showTournament('Trackmania 2 Canyon');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/tm2.png', 'alt="TM2"') ?></span>
<span onmouseover="showTournament('Trackmania Nations Forever');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/tmnf.png', 'alt="TMNF"') ?></span>
<span onmouseover="showTournament('Trackmania United Forever');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/tmu.png', 'alt="TMU"') ?></span>
<span onmouseover="showTournament('Shootmania Storm');" onmouseout="hideTournament();"><?= image_tag('/uploads/jeux/icones-24/sms.png', 'alt="SMS"') ?></span>


<span id="toplink-special"></span>

<script>
function showTournament(string) {
    $('#toplink-special').fadeIn(200)
    $('#toplink-special').html(string);
}

function hideTournament() {
    $('#toplink-special').fadeOut(200);
    $('#toplink-special').html('');
}
</script>
