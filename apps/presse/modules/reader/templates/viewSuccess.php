	<div id="magazine">
		<?php foreach ($magazine as $page): ?>
			<div style="background-image:url(http://presse.futurolan.net/uploads/presse/reader/<?php echo $slug?>/<?php echo $page?>.jpg);"></div>
		<?php endforeach; ?>
	</div>

	<div id="pager">
		<span><i style="cursor: pointer;" onclick="$('#magazine').turn('page', 1);"><<</a></span>
		<span><i style="cursor: pointer;" onclick="$('#magazine').turn('previous');"><</a></span>
		<span>&nbsp;&nbsp;<i style="width: 80px;"><span id="current_pager">1</span> / <?php echo $nb_pages; ?></a>&nbsp;&nbsp;</span>
		<span><i style="cursor: pointer;" onclick="$('#magazine').turn('next');">></a></span>
		<span><i style="cursor: pointer;" onclick="$('#magazine').turn('page', <?php echo $nb_pages; ?>);">>></a></span>
		<div style="clear: left;"></div>
	</div>
	
	<div id="toolbox">
		<i style="cursor: pointer;" onclick="zoom();" title="Zoom +">+</a> 
		<i style="cursor: pointer;" onclick="dezoom();" title="Zoom -">-</a>
		<?php if ($pdf): ?>
                        <a href="http://presse.futurolan.net/uploads/presse/reader/<?php echo $slug?>/<?php echo $slug?>.pdf"style="font-size: 12px;font-weight:bold; line-height: 30px;" title="Telecharger au format PDF">PDF</a>
                <?php endif; ?>
	</div>


	<script type="text/javascript">

		$(window).ready(function() {
			$('#magazine').turn({
				display: '<?php echo $display?>',
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

<?php slot('filename'); ?>
	<?php echo 'Reader'; ?>
<?php end_slot(); ?>
