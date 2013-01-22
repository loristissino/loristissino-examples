<h1><?php echo Yii::t('App', 'Internationalization experiments') ?></h1>

<h2>Current language: <?php echo Yii::app()->language ?></h2>

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

<h2>Preferences</h2>
<p>Preferred language: <?php print_r(Yii::app()->request->getPreferredLanguage()) ?></p>

<h2>A loop for supported languages</h2>
<?php foreach(array('en', 'it', 'pl') as $lang): ?>
  <?php Yii::app()->language=$lang ?>
  <p><?php echo $lang ?>: <?php echo Yii::t('App', 'Internationalization experiments') ?></p>
<?php endforeach ?>
