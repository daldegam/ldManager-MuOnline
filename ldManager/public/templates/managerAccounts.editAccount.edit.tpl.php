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
        <h2 class="sevr"><?php echo $language->sentence["MNG_ACC_EA_TITLE_H2"]; ?></h2>
        <form id="form" method="post" action="?call=managerAccounts&subCall=editAccount&action=write">
            <ol>
              <li>
                <label for="username"><?php echo $language->sentence["MNG_ACC_EA_LABEL_USERNAME"]; ?></label>    
                <input name="username" type="text" value="<?php echo (isset($managerAccounts->infos->memb___id) ? $managerAccounts->infos->memb___id : ''); ?>" maxlength="10" readonly="readonly" />
              </li>
              <li>
                <label for="password"><?php echo $language->sentence["MNG_ACC_EA_LABEL_PASSWORD"]; ?></label>    
                <input name="password" type="text" value="<?php echo (isset($managerAccounts->infos->memb__pwd) ? $managerAccounts->infos->memb__pwd : ''); ?>" maxlength="10" /> <?php if($managerAccounts->settings->md5_encode == true) echo $language->sentence['MNG_ACC_EA_ENABLED_MD5']; ?>
              </li>
              <li>
                <label for="name"><?php echo $language->sentence["MNG_ACC_EA_LABEL_NAME"]; ?></label>    
                <input name="name" type="text" value="<?php echo (isset($managerAccounts->infos->memb_name) ? $managerAccounts->infos->memb_name : ''); ?>" maxlength="50" />
              </li>
              <li>
                <label for="email"><?php echo $language->sentence["MNG_ACC_EA_LABEL_EMAIL"]; ?></label>    
                <input name="email" type="text" value="<?php echo (isset($managerAccounts->infos->mail_addr) ? $managerAccounts->infos->mail_addr : ''); ?>" maxlength="50" />
              </li>
              <li>
                <label for="personalid"><?php echo $language->sentence["MNG_ACC_EA_LABEL_PERSONALID"]; ?></label>    
                <input name="personalid" type="text" value="<?php echo (isset($managerAccounts->infos->sno__numb) ? $managerAccounts->infos->sno__numb : ''); ?>" maxlength="18" />
              </li>
              <li>
                <label for="question"><?php echo $language->sentence["MNG_ACC_EA_LABEL_QUESTION"]; ?></label>    
                <input name="question" type="text" value="<?php echo (isset($managerAccounts->infos->fpas_ques) ? $managerAccounts->infos->fpas_ques : ''); ?>" maxlength="50" />
              </li>
              <li>
                <label for="answer"><?php echo $language->sentence["MNG_ACC_EA_LABEL_ANSWER"]; ?></label>    
                <input name="answer" type="text" value="<?php echo (isset($managerAccounts->infos->fpas_answ) ? $managerAccounts->infos->fpas_answ : ''); ?>" maxlength="20" />
              </li>
              <li>                                                                                       
                <input type="submit" value="<?php echo $language->sentence["MNG_ACC_EA_BT_SAVE"]; ?>" />
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
          <li><a href="?call=managerAccounts&subCall=editAccount"><strong><?php echo $language->sentence["MNG_ACC_SUB_MENU_EDIT_ACCOUNT"]; ?></strong></a></li>
          <li><a href="?call=managerAccounts&subCall=removeAccount"><?php echo $language->sentence["MNG_ACC_SUB_MENU_REMOVE_ACCOUNT"]; ?></a></li>
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