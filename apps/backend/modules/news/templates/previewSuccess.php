<h2>Actualit&eacute;s > <?php echo $news->getTitle()?> > Aper&ccedil;u</h2>

<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<style>
.box {
    margin-top: 0px;
    margin-bottom: 25px;
}
.box .title {
    margin-bottom: 10px;
    font-size: 16px;
}
.box .subtitle {
    border-bottom: solid 1px #ddd;
    font-size: 15px;
    margin: 20px 0px 10px 0px;
}
.box .content {
    line-height: 17px;
}
.box .content p {
    text-align: justify;
}
#content .box {
    width: 720px;
}
#content .box .title {
    font-size: 16px;
    margin-bottom: 15px;
    padding: 5px;
    background-color: #e1e1e1;
}
#content .box .content {
}
</style>
<div class="box">
    <div class="title"><?php echo ucfirst($news->getTitle())?></div>
    <div class="content">
                <span style="font-size: 10px; color: grey;">Publi&eacute; le <?php echo format_date($news->getPublishOn(), 'dd/MM/yyy')?> par <?php echo link_to($news->getSfGuardUser(), 'user/view?username='.$news->getSfGuardUser())?></span>
    <?php echo bb_parse($news->getContent())?>
    </div>
</div>
