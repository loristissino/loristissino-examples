<h1>Screen resolution</h1>
<?php if(!$width || !$height): ?>
<?php 
$cs = Yii::app()->getClientScript();  
$cs->registerScript(
  'screendetection',
  '
  var url = "' . CHtml::normalizeUrl(array('experiments/screenresolution')) . '";
  window.location.replace(url + "&width=" + screen.width + "&height=" + screen.height);
  ',
  CClientScript::POS_END
);
?>
<?php else: ?>
<p>Width: <?php echo $width ?></p>
<p>Height: <?php echo $height ?></p>
<?php endif ?>
