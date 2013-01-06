<?use_helper('Date') ?>

<?php $maintenant = date("Y-m-d H:i:s");
	foreach ($nextevents as $event):
		if ($event->getEndAt()<$maintenant):
			echo '';

		else:?>
			<?=image_tag('../uploads/events/'.$event->getImage())?>

            
            <? 	
            if ($event->getStartRegistrationAt() < $maintenant):
                if ($maintenant < $event->getEndRegistrationAt()): 
                    //Inscriptions ouverte
                endif;
            endif;	
            
           // echo image_tag('/uploads/events/'.$event->getImage(), 'alt="'.$event->getName().'"');
		endif;
	endforeach;?>



<!--<?/*use_helper('Date') ?>
<h3>Prochain &eacute;v&egrave;nement</h3>
<?php $maintenant = date("Y-m-d H:i:s");
	foreach ($nextevents as $event):
		if ($event->getEndAt()<$maintenant):
			echo 'aucun evenement';

		else:?>
			<h5><?=$event->getName()?></h5>
			<?php
			list($date, $time) = explode(' ', $event->getStartAt());
			list($year, $month, $day) = explode('-', $date);
			list($hour, $minute, $second) = explode(':', $time);
			$startAt = mktime($hour, $minute, $second, $month, $day, $year);
			list($date, $time) = explode(' ', $event->getEndAt());
			list($year, $month, $day) = explode('-', $date);
			list($hour, $minute, $second) = explode(':', $time);
			$endAt = mktime($hour, $minute, $second, $month, $day, $year);
			?>
			<i style="font-size: 10px;">
        <?=format_date($event->getStartAt(), 'dd', 'fr_FR') ?> au <?=format_date($event->getEndAt(), 'dd MMMM yyyy', 'fr_FR') ?><br />
				<?=$event->getDescription()?>
			</i>
            
            <? 	
            if ($event->getStartRegistrationAt() < $maintenant):
                if ($maintenant < $event->getEndRegistrationAt()): ?>
                  <br/><br/>
                  Inscriptions ouverte - <?=link_to('Liste des inscrits','tournament_slot/list')?>
                <? endif;
            endif;	
            
           // echo image_tag('/uploads/events/'.$event->getImage(), 'alt="'.$event->getName().'"');
		endif;
	endforeach;*/?>
-->
