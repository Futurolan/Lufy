<h2>Upload</h2>

<a class="button" href="#">Uploader un fichier</a>

<script>
function fade(id) {
    if ($('#rep-'+id+'>p').is(':hidden')) {
        $('#rep-'+id+'>p').fadeIn('slow');
    }
    else {
        $('#rep-'+id+'>p').fadeOut('fast');
    }
    
//    alert('OK');
}
</script>

<?
$last_dir = 0;
$i = 0;
foreach ($files as $file): ?>
    <?php
    if (is_dir(sfConfig::get('sf_upload_dir').'/'.$file)):
        $explode = explode('/', $file);
        if ($explode[0] == $last_dir[0]):
            echo '<span style="display: block; width: 90%; padding: 5px; padding-left: 15px; border: solid 1px #ccc; background: #f0f0f0; margin-top: 5px; margin-bottom: 15px;">'.$file.'</span>';
        else:
            if ($last_dir !=0):
                echo '</p></div>';
            endif;
            echo '<div id="rep-'.$i.'"><h3 style="width: 90%; padding: 10px; border: solid 1px #ccc; background: #efefea;"><a href="#" onclick="javascript:fade('.$i.');">+</a> '.$file.'</h3><p style="display: none; margin-bottom: 30px;">';
        endif;
        $last_dir = $explode;
    elseif (is_file(sfConfig::get('sf_upload_dir').'/'.$file)):
        echo "<img src='../uploads/$file' width='50px' />";
    endif;
    $i++;
    ?>
<? endforeach; ?>