<div class="header">
    <div class="block_header">
      <div class="logo">
          <img src="public/templates/images/logo.jpg" />
      </div>
      <div class="clr"></div>
      <div class="menu">
        <ul>
          <?php $_GET['call'] = isset($_GET['call']) == true ? $_GET['call'] : ''; ?>
          <li><a href="?" <?php echo (empty($_GET['call']) == true ? 'class="active"':''); ?>><span><?php echo $language->sentence["HEADER_BT_HOME"]; ?></span></a></li>
          <li><a href="?call=managerAccounts" <?php echo ($_GET['call'] == 'managerAccounts' ? 'class="active"':''); ?>><span><?php echo $language->sentence["HEADER_BT_MANAGER_ACCOUNTS"]; ?></span></a></li>
          <li><a href="?call=managerCharacters" <?php echo ($_GET['call'] == 'managerCharacters' ? 'class="active"':''); ?>><span><?php echo $language->sentence["HEADER_BT_MANAGER_CHARACTERS"]; ?></span></a></li>
          <li><a href="?call=managerGuilds" <?php echo ($_GET['call'] == 'managerGuilds' ? 'class="active"':''); ?>><span><?php echo $language->sentence["HEADER_BT_MANAGER_GUILDS"]; ?></span></a></li>
          <li><a href="?call=managerFiles" <?php echo ($_GET['call'] == 'managerFiles' ? 'class="active"':''); ?>><span><?php echo $language->sentence["HEADER_BT_MANAGER_FILES"]; ?></span></a></li>
          <li><a href="?call=managerSettings" <?php echo ($_GET['call'] == 'managerSettings' ? 'class="active"':''); ?>><span><?php echo $language->sentence["HEADER_BT_MANAGER_SETTINGS"]; ?></span></a></li>
          <li><a href="?call=logout"><span><?php echo $language->sentence["HEADER_BT_LOGOUT"]; ?></span></a></li>
          <li><a href="?call=about" <?php echo ($_GET['call'] == 'about' ? 'class="active"':''); ?>><span><?php echo $language->sentence["HEADER_BT_ABOUT"]; ?></span></a></li>
          <li><a href="../"><span><?php echo $language->sentence["HEADER_BT_GO_SITE"]; ?></span></a></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>