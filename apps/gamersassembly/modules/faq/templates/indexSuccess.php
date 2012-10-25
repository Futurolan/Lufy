<? use_helper('bb') ?>
<div class="box">
    <div class="title">Foire aux questions</div>
    <div class="content">
	<ol>
	<?php foreach ($faqs as $faq): ?>
	    <li style="padding:5px;"><a href="#<?php echo $faq->getPosition() ?>"><?php echo $faq->getRequest() ?></a></li>
	<?php endforeach; ?>
	</ol>
	<br/><br/>

	<?php foreach ($faqs as $faq): ?>
        <div style="background-color:#eee;border:solid 1px #ddd;padding: 10px;">
            <span style="font-size:14px;"><a name="<?php echo $faq->getPosition() ?>"><?php echo $faq->getRequest() ?></a></span><br/>
            <?php echo bb_parse($faq->getAnswer()) ?>
        </div>
        <br/>
	<?php endforeach; ?>
    </div>
</div>
