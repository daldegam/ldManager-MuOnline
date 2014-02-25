<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="public/templates/style.css" rel="stylesheet" type="text/css" />
<title><?php echo $language->sentence["TITLE"]; ?></title>
</head>

<body>
<div class="main">
  <?php require("header.auth.tpl.php"); ?>
  <div class="clr"></div>
  <div class="blog_body">
    <div class="blog_bottom">
      <div class="left">
        <h2 class="sevr"><?php echo $language->sentence["MNG_ACC_RA_TITLE_H2"]; ?></h2>
        <form id="form" method="post" action="?call=managerAccounts&subCall=removeAccount&action=remove">
            <ol>
              <li>
                <label for="username"><?php echo $language->sentence["MNG_ACC_RA_LABEL_USERNAME"]; ?></label>    
                <input name="username" type="text" value="<?php echo (isset($_POST['username']) ? $_POST['username'] : ''); ?>" maxlength="10" />
              </li> 
              <li>                                                                                       
                <input type="submit" value="<?php echo $language->sentence["MNG_ACC_RA_BT_REMOVE"]; ?>" />
              </li>
            </ol>
        </form>
        <?php
            if(empty($managerAccounts->sentense) == false)
            {
                printf("<p>%s</p>", $language->sentence[$managerAccounts->sentense]);  
            }
        ?>
        <div class="bg"></div>
      </div>
      <div class="right">
        <h2><?php echo $language->sentence["MNG_ACC_SUB_MENU"]; ?></h2>
        <ul>
          <li><a href="?call=managerAccounts&subCall=createAccount"><?php echo $language->sentence["MNG_ACC_SUB_MENU_CREATE_ACCOUNT"]; ?></a></li>
          <li><a href="?call=managerAccounts&subCall=editAccount"><?php echo $language->sentence["MNG_ACC_SUB_MENU_EDIT_ACCOUNT"]; ?></a></li>
          <li><a href="?call=managerAccounts&subCall=removeAccount"><strong><?php echo $language->sentence["MNG_ACC_SUB_MENU_REMOVE_ACCOUNT"]; ?></strong></a></li>
          <li><a href="?call=managerAccounts&subCall=editVault"><?php echo $language->sentence["MNG_ACC_SUB_MENU_EDIT_VAULT"]; ?></a></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
  
  <?php require("footer.tpl.php"); ?>
</div>
</body>
</html>