<?php use_helper('bb') ?>

<h2>Foire aux questions</h2>

<ol>
  <?php foreach ($faqs as $faq): ?>
    <li>
      <a href="#" onclick="$('.well').slideUp(); $('.well-<?php echo $faq->getIdFaq(); ?>').slideDown();"><?php echo $faq->getRequest() ?></a>
      <div class="well well-<?php echo $faq->getIdFaq(); ?>">
        <?php echo bb_parse($faq->getAnswer()) ?>
      </div>
    </li>
  <?php endforeach; ?>
</ol>

<style>
ol li {
  margin-bottom: 20px;
}
.well {
  display: none;
  margin-top: 5px;
}
</style>

<script>

</script>
