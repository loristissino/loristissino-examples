<?php
require("config.php"); 
require("functions.php");

$action=getUrlValue('action', '');

$jqcode="";

$template = $action;

switch ($action)
{	
  case 'ajaxtest1':
    break;
  case 'ajaxtest2':
    break;
  case 'ajaxtest3':
    break;
  case 'ajaxtest4':
    break;
  case 'ajaxtest5':
    break;
  case 'ajaxtest6':
    break;
  case 'ajaxtest7':
    break;
  case 'ajaxtest8':
    break;
  case 'slowaction':
    $seconds = getPostValue('seconds', 5);
    sleep($seconds);
    header("Location: ?action=completed");
    break;
	case 'index':
    break;
  case 'completed':
    break;
	default:
		header("Location: ?action=index");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?php echo sprintf('%s | %s', $config['site_name'], $action) ?></title>
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<script src="js/jquery.min.js"></script>
</head>

<body>
	<h1><?php echo $config['site_name'] ?></h1>
	<?php include("templates/" . $template . ".php"); ?>
</body>

<hr />
<div class="bottomline"><a href="?action=index">Home</a></div>

<script>
  $(document).ready(function(){
    <?php echo $jqcode ?>
  });
</script>
</html>
