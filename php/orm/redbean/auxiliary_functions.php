<?php

function heading($level, $text)
{
  echo sprintf('<h%1$d>%2$s</h%1$d>', $level, $text) . "\n";
}

function comment($text, $line=null, $color='#000000')
{
  echo sprintf('<em style="color: %s">%s</em>', $color, $text);
  if($line) echo sprintf(' (line %d)', $line);
  echo "\n";
}
