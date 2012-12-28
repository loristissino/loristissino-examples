<?php

require('functions/generic_functions.php');

class GenericFunctionsTest extends PHPUnit_Framework_TestCase
{
    public function testLink_to()
    {
        $this->assertEquals(link_to('foo', 'bar'), '<a href="bar">foo</a>');
        $this->assertEquals(link_to('foo', 'bar', array('title'=>'baz')), '<a href="bar" title="baz">foo</a>');
        $this->assertEquals(link_to('foo', 'bar', array('title'=>'baz', 'class'=>'baz')), '<a href="bar" title="baz" class="baz">foo</a>');
    }

    /**
     * @dataProvider images_provider
     */  
    public function testIs_image($name, $result)
    {
        $this->assertEquals(is_image($name), $result);
    }
    
    public function images_provider()
    {
      return array(
        array('.', false),
        array('..', false),
        array('.foo.jpg', false),
        array('foo.doc', false),
        array('foo.jpg', true),
        array('foo.jpeg', true),
        array('foo.png', true),
        array('foo.gif', true),
        array('FOO.JPG', true),
        array('FOO.PNG', true),
      );
    }
}
