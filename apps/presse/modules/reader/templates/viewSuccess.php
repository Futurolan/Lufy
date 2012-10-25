	<div id="magazine">
		<? foreach ($magazine as $page): ?>
			<div style="background-image:url(http://presse.futurolan.net/uploads/presse/reader/<?=$slug?>/<?=$page?>.jpg);"></div>
		<? endforeach; ?>
	</div>

	<div id="pager">
		<span><a style="cursor: pointer;" onclick="$('#magazine').turn('page', 1);"><<</a></span>
		<span><a style="cursor: pointer;" onclick="$('#magazine').turn('previous');"><</a></span>
		<span>&nbsp;&nbsp;<a style="width: 80px;"><span id="current_pager">1</span> / <?php echo $nb_pages; ?></a>&nbsp;&nbsp;</span>
		<span><a style="cursor: pointer;" onclick="$('#magazine').turn('next');">></a></span>
		<span><a style="cursor: pointer;" onclick="$('#magazine').turn('page', <?php echo $nb_pages; ?>);">>></a></span>
		<div style="clear: left;"></div>
	</div>
	
	<div id="toolbox">
		<a style="cursor: pointer;" onclick="zoom();" title="Zoom +">+</a> 
		<a style="cursor: pointer;" onclick="dezoom();" title="Zoom -">-</a>
		<? if ($pdf): ?>
                        <a href="http://presse.futurolan.net/uploads/presse/reader/<?=$slug?>/<?=$slug?>.pdf"style="font-size: 12px;font-weight:bold; line-height: 30px;" title="Telecharger au format PDF">PDF</a>
                <? endif; ?>
	</div>


	<script type="text/javascript">

		$(window).ready(function() {
			$('#magazine').turn({
				display: '<?=$display?>',
				acceleration: true,
				gradients: true,
				when: {
					turned: function(e, page) {
						$('#current_pager').html($('#magazine').turn('page'));
					}
				}
			});
		});
		
		
		$(window).bind('keydown', function(e) {
			if (e.keyCode==37)
				$('#magazine').turn('previous');
			else if (e.keyCode==39)
				$('#magazine').turn('next');
		});

				
	function zoom() {
		height = $('#magazine').height();
		height+= height*0.30;
		width = $('#magazine').width();
		width+= height*0.24;
		$('#magazine').turn('size', width, height);
	}
	function dezoom() {
		height = $('#magazine').height();
		height-= height*0.24;
		width = $('#magazine').width();
		width-= height*0.30;
		$('#magazine').turn('size', width, height);
	}
	</script>

<? slot('filename'); ?>
	<? echo 'Reader'; ?>
<? end_slot(); ?>
