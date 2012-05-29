<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it" xml:lang="it">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mini blog :: <?php echo $title ?></title>
<?php if(isset($refresh)): ?>
<meta http-equiv="refresh" content="5;url=<?php echo $refresh ?>">
<?php endif ?>
</head>
<body>
<h1><?php echo $title ?></h1>
<?php include('templates/' . $template . '.php') ?>
<hr />
<?php if($action!='new'): ?>
  <p><a href="?action=new">Nuovo post</a></p>
  <hr />
<?php endif ?>
<p>Test:</p>
<ul>
<li><a href="?action=foo">Azione non consentita</a></li>
<li><a href="?action=show&slug=bar">Articolo non esistente</a></li>
</ul>

<div style="background-color:#DCFF8E; font-family: sans-serif; text-align:center">Miniblog didattico MVC in PHP - versione basata su db MySql</div>
</body>
</html>
