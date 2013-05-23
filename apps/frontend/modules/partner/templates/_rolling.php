<div id="partner_rolling">
  <ul id="rolling">
  <?php foreach ($partners as $partner): ?>
    <li><?php echo image_tag('/uploads/partenaires/100/'.$partner->getLogourl())?></li>
  <?php endforeach; ?>
  </ul>
</div>

<script type="text/javascript">
$(function(){
  setInterval(function(){
    $("ul#rolling").animate({marginLeft:-120},800,function(){
      $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
    })
  }, 2000);
});
</script>

<style>

#partner_rolling {
  width: 240px;
  height: 100px;
  overflow: hidden;
  margin: auto auto;
  margin-bottom: 10px;
  text-align: center;
}
ul#rolling {
  width: 200%;
  height: 100px;
  padding:0;
  margin:0;
  list-style: none;
}
ul#rolling li {
  width: 100px;
  height: 100px;
  position: relative;
  display: block;
  float: left;
  background: #fff;
  margin: 0px 10px 0px 10px;
  text-align: center;
  line-height: 100px;
}
</style>
