<?php
// protected/components/helpers.php
// see http://www.yiiframework.com/wiki/165/understanding-autoloading-helper-classes-and-helper-functions/

function text_underlined($text, $new_lines_before=2, $new_lines_after=1, $symbol='=')
{
  return
    str_repeat("\n", $new_lines_before)
    . $text
    . "\n"
    . str_repeat($symbol, strlen($text))
    . str_repeat("\n", $new_lines_after)
    ;
}
