<?php

function heading($level, $text)
{
  echo sprintf('<h%1$d>%2$s</h%1$d>', $level, $text) . "\n";
}

function comment($text, $line=null, $color='#000000')
{
  $codebase = 'http://code.google.com/p/loristissino-examples/source/browse/php/orm/redbean/index.php';
  echo sprintf('<em style="color: %s">%s</em>', $color, $text);
  if($line) echo sprintf(' (<a href="%s#%2$d">line %2$d</a>)', $codebase, $line);
  echo "\n";
}
