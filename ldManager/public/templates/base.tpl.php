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
        <h2 class="sevr">Gerenciar contas</h2>
        <p>Bla bla bla</p>
        <div class="bg"></div>
      </div>
      <div class="right">
        <h2>Op&ccedil;&otilde;es</h2>
        <ul>
          <li><a href="#">Criar conta</a></li>
          <li><a href="#">Editar conta</a></li>
          <li><a href="#">Deletar conta</a></li>
          <li><a href="#">Editar ba&uacute;</a></li>
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