<?php

/*
 *  run this command with something like:
 *  ./yiic managepictures
 *  ./yiic managepictures check
 * 
 * see http://www.yiiframework.com/doc/guide/1.1/en/topics.console
*/

class ManagepicturesCommand extends CConsoleCommand
{
  public function actionIndex()
  {
    echo "You can use this command for various activities...\n";
  }
  
  public function actionTestarguments($myoption1, $myoption2="foo", $args=array())
  {
    echo "Showing arguments...\n";
    echo $option1 . "\n";
    echo $option2 . "\n";
    print_r($args);
  }
  
  public function actionCheck()
  {
    $pictures = Picture::model()->findAll();
    
    foreach($pictures as $picture)
    {
      echo $picture . "\n";
      echo sprintf('  %d pixel(s)', $picture->pixels) . "\n";
    }
  }
}
