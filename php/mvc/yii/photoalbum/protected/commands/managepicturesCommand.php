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
    echo text_underlined('Basic example', 0);
    
    $pictures = Picture::model()->findAll();
    
    foreach($pictures as $picture)
    {
      echo $picture . "\n";
      echo sprintf('  %d pixel(s)', $picture->pixels) . "\n";
    }
    
    echo text_underlined('Lazy loading example');

    $pictures = Picture::model()->findAll();
    foreach($pictures as $picture)
    {
      echo $picture . "\n";
      echo sprintf('  Category: %s', $picture->category) . "\n";
    }
    
    echo text_underlined('Eager loading example');
    
    // see http://www.yiiframework.com/doc/guide/1.2/en/database.arr

    $pictures = Picture::model()->with('category')->findAll();
    foreach($pictures as $picture)
    {
      echo $picture . "\n";
      echo sprintf('  Category: %s', $picture->category) . "\n";
    }

    echo text_underlined('Another eager loading example');

    $pictures = Picture::model()->with('category', 'people')->findAll();
    foreach($pictures as $picture)
    {
      echo $picture . "\n";
      echo sprintf('  Category: %s', $picture->category) . "\n";
      if(sizeof($picture->people))
      {
        echo '  People:' . "\n";
        foreach($picture->people as $person)
        {
          echo '    ' . $person . "\n";
        }
      }
    }
  }

  public function actionGenerate($number, $scenario='insert')
  {
    echo text_underlined(sprintf('Generating %d new pictures...', $number));
    
    $types=array('jpeg', 'png', 'gif', 'foo', 'bar');
    
    for($i=0; $i<$number; $i++)
    {
      $mypicture = new Picture();
      $mypicture->description = 'Picture #' . $i;
      echo text_underlined($mypicture->description, 1, 1, '-');
      $mypicture->scenario=$scenario;
      $mypicture->type = $types[rand(0, sizeof($types)-1)];
      $mypicture->width = 0;  // this will validate on scenario 'insert', and not on scenario 'informationRetrieval'
      $mypicture->height = 0;
      
      echo 'Picture data ok? ' . ($mypicture->validate() ? 'true' : 'false' ) . "\n";
      //echo $mypicture->scenario . "\n";
      if($mypicture->save())
      {
        echo 'Saved picture ' . $mypicture . "\n";
        //echo $mypicture->scenario . "\n";
      }
      else
      {
        echo 'Could not save picture ' . $mypicture . "\n";
        //echo $mypicture->scenario . "\n";
      }
    }
  } 
    
}
