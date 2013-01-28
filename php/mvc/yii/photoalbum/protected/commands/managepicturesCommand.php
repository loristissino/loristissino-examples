<?php

/*
 *  run this command with something like:
 *  ./yiic managepictures
 *  ./yiic managepictures check
 *  -/yiic managepictures testarguments --myoption1='foo'
 * 
 * see http://www.yiiframework.com/doc/guide/1.1/en/topics.console
*/

class ManagepicturesCommand extends CConsoleCommand
{
  
  public function actionIndex()
  {
    echo "You can use this command for various activities...\n";
    //echo Yii::app()->params['picturesDirectory'] . "\n";
  }
  
  public function actionTestarguments($myoption1, $myoption2="foo", $args=array())
  {
    // use: [command] --myoption1="foo" --myoption2="bar" argumen01 argument02
    
    echo "Showing arguments...\n";
    echo $myoption1 . "\n";
    echo $myoption2 . "\n";
    print_r($args);
  }
  
  public function actionCheck($storeInformation=false)
  {
    $pictures = Picture::model()->findAll();
    
    foreach($pictures as $picture)
    {
      echo $picture . "\n";
      $errors = $picture->checkFile(Yii::app()->params['picturesDirectory'], $storeInformation);
      if(sizeof($errors))
      {
        print_r($errors);
      }
    }
  }

  public function actionList()
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

  public function actionConstructorsdemo()
  {
    echo 'This makes no sense: ' . Picture::model()->realwidth . "\n";
    echo 'This does make sense: ' . "\n";
    print_r(Picture::model()->relations());
    $picture1 = new Picture();
    $picture1->description = 'picture 1';
    echo 'The correct way to instantiate an object: '. $picture1 . ' ' . get_class($picture1) . "\n";
    echo 'It works: ' . $picture1->realwidth . "\n";
    $picture2 = Picture::model();
    $picture2->description = 'picture 2';
    echo 'A really BAD IDEA to instantiate an object: '. $picture2 . ' ' . get_class($picture2) . "\n";
    echo 'It does not work: ' . $picture2->realwidth . "\n";
  }

  public function actionTransactionsdemo()
  {
    $transaction = Yii::app()->db->beginTransaction();
    
    $picture = new Picture();
    $picture->description="Foo";
    $picture->height=100;
    $picture->width=200;
    
    $picture->save(false);
    $id=$picture->id;
    
    echo sprintf("Picture %s saved with id=%d", $picture,  $id) . "\n";
    if($picture=Picture::model()->findByPk($id))
    {
      echo sprintf("Picture %s found", $picture,  $id) . "\n";
    }
    else
    {
      echo sprintf("Picture not found") . "\n";
    }
    
    // $transaction->commit();
    echo "Rolling back...\n";
    $transaction->rollBack();
    
    $picture=Picture::model()->findByPk($id);
    if($picture=Picture::model()->findByPk($id))
    {
      echo sprintf("Picture %s found", $picture,  $id) . "\n";
    }
    else
    {
      echo sprintf("Picture not found") . "\n";
    }
  }

    
}
