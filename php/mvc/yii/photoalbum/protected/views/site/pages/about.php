<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is a demo website aimed to illustrate how Yii framework works. It is not complete, since it is meant to be something to work on to build something better.</p>
<p>The source code is available at <?php echo CHtml::link('Google Code', 'http://code.google.com/p/loristissino-examples/source/browse/php/mvc/yii/photoalbum/') ?>.</p>

<h2>Author</h2>

<p>WondefulPhotoAlbum &copy; 2012/13 <?php echo CHtml::link('Loris Tissino', 'http://loris.tissino.it') ?></p>

<h2>Licence</h2>

<p>This program is free software: you can redistribute it and/or modify
it under the terms of the <?php echo CHtml::link('GNU General Public License', 'http://www.gnu.org/licenses/gpl.html') ?> as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.</p>

<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.</p>

