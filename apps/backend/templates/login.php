<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div id="body" style="margin: auto auto;">
            <? if ($sf_user->hasFlash('success')) echo '<div class="flashbox success">'.$sf_user->getFlash('success').'</div>'; ?>
            <? if ($sf_user->hasFlash('info')) echo '<div class="flashbox info">'.$sf_user->getFlash('info').'</div>'; ?>
            <? if ($sf_user->hasFlash('warning')) echo '<div class="flashbox warning">'.$sf_user->getFlash('warning').'</div>'; ?>
            <? if ($sf_user->hasFlash('error')) echo '<div class="flashbox error">'.$sf_user->getFlash('error').'</div>'; ?>
            <div style="background: #fff; border: solid 1px #ccc; height: 180px; width: 300px; margin: 200px auto; padding: 7px 19px 20px 19px; box-shadow: 0px 0px 20px #ccc;">
                <h2>Administration > Identification</h2>

                <?php echo $sf_content ?>

            </div>
        </div>
    </body>
</html>
