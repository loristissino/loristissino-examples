<h1>I18N experiments</h1>

<p><?php
  echo Yii::t('App', 'The directory "{path}" is not readable.',
    array('{path}'=>$path))
?>
</p>

<h2>English</h2>
<?php Yii::app()->language='en' ?>
<ul>
<?php for($i=0; $i<=10; $i++): ?>
<li><?php echo Yii::t('App', '{n} file|{n} files', $i); ?></li>
<?php endfor ?>
</ul>
<p>Pi: <?php echo Yii::app()->numberFormatter->formatDecimal(3.14) ?></p>


<h2>Italian</h2>
<?php Yii::app()->language='it' ?>
<ul>
<?php for($i=0; $i<=10; $i++): ?>
<li><?php echo Yii::t('App', '{n} file|{n} files', $i); ?></li>
<?php endfor ?>
</ul>
<p>Pi: <?php echo Yii::app()->numberFormatter->formatDecimal(3.14) ?></p>

<h2>Polish</h2>
<?php Yii::app()->language='pl' ?>
<ul>
<?php for($i=0; $i<=30; $i++): ?>
<li><?php echo Yii::t('App', '{n} file|{n} files', $i); ?></li>
<?php endfor ?>
</ul>
<p>Pi: <?php echo Yii::app()->numberFormatter->formatDecimal(3.14) ?></p>
