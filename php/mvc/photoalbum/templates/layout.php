<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title><?php echo $this->title ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.22" />
	<style type="text/css">
		.error
		{
			background-color: yellow;
		}
    .picture_caption
    {
      color: blue;
    }
	</style>
</head>

<body>
	
	<h1><?php echo $this->title ?></h1>
	
	<?php include($this->template . '.php') ?>
  <?php // viene incluso il template specificato, che sarà la parte specifica a seconda dell'azione richiesta // ?>
	
	<hr />
	
	<p><?php echo link_to('Lista', '?action=list') ?> - <?php echo link_to('Miniature', '?action=preview') ?></p>
	
	
</body>

</html>
