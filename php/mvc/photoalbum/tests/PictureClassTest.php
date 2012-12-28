<?php

global $config;
require_once('config.php');  // inclusione del file di configurazione
require_once('functions/generic_functions.php');  // inclusione di un file di funzioni

class PictureClassTest extends PHPUnit_Framework_TestCase
{
  
  protected function setUp()
  {
    // for db connection, see http://www.phpunit.de/manual/current/en/database.html
    // this is here only to show how the setUp() function works
    $this->dbh = new PDO(AppConfig::get('db_connection'), AppConfig::get('db_user'), AppConfig::get('db_password'));
    $this->pa = new PhotoAlbum('winterpictures', $this->dbh);
  }
   
  protected function tearDown()
  {
    unset($this->dbh);
  } 
  
  public function testGetWidthAndHeight()
  {
    $p  = new Picture($this->pa, 'flanders.jpg');
    
    $this->assertEquals($p->getWidth(), 640);
    $this->assertEquals($p->getHeight(), 425);
  }

  public function testGetIsValid()
  {
    $p  = new Picture($this->pa, 'flanders.jpg');
    $this->assertEquals($p->getIsValid(), true);
    $p  = new Picture($this->pa, 'not_a_valid_file.jpg');
    $this->assertEquals($p->getIsValid(), false);
  }

  /**
   * @expectedException Exception
   */
  public function testExceptionForInvalidFiles()
  {
    $p  = new Picture($this->pa, 'not_a_valid_file.jpg');
    $p->getWidth();
  }
  
}
