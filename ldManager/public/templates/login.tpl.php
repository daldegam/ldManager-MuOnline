<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="public/templates/style.css" rel="stylesheet" type="text/css" />
<title><?php echo $language->sentence["TITLE"]; ?></title>
</head>

<body>
<div class="main">
  <?php require("header.noauth.tpl.php"); ?>
  <div class="clr"></div>
  <div class="blog_body">
    <div class="blog_bottom">
      <div class="left">
        <h2 class="what"><?php echo $language->sentence["LOGIN_TITLE_H2"]; ?></h2>
        <form id="form" method="post" action="?call=login">
            <ol>
              <li>
                <label for="username"><?php echo $language->sentence["LOGIN_LABEL_USERNAME"]; ?></label>    
                <input name="username" type="text" value="" />
              </li>
              <li>
                <label for="password"><?php echo $language->sentence["LOGIN_LABEL_PASSWORD"]; ?></label>    
                <input name="password" type="password" value="" />
              </li>
              <li>                                                                                       
                <input type="submit" value="<?php echo $language->sentence["LOGIN_BT_AUTENTICATE"]; ?>" />
              </li>
            </ol>
        </form>
        <?php
            if(empty($login->sentense) == false)
            {
                printf("<p>%s</p>", $language->sentence[$login->sentense]);  
            }
        ?>      
        <div class="bg"></div>
      </div>
      <div class="right">
      </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
  
  <?php require("footer.tpl.php"); ?>
</div>
</body>
</html>