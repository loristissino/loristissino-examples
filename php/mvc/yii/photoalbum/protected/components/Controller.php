<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
  
	/**
	 * Serves an object as a json-encoded string via HTTP.
	 * @param string $object the object to send
	 */  
  public function serveJson($object)
  {
    $this->serveContent('application/json', CJSON::encode($object), false);
  }

	/**
	 * Serves a content via HTTP.
	 * @param string $type the Internet Media Type (MIME) of the content
   * @param string $content the content to send
	 */  
  public function serveContent($type, $content)
  {
    $this->_serve($type, $content, false);
  }
  
	/**
	 * Serves a file via HTTP.
	 * @param string $type the Internet Media Type (MIME) of the file
   * @param string $file the file to send
	 */  
  public function serveFile($type, $file)
  {
    $this->_serve($type, $file, true);
  }

	/**
	 * Serves something via HTTP.
	 * @param string $type the Internet Media Type (MIME) of the content
   * @param string $content the content to send
   * @param boolean $is_file whether the content is a file
	 */  
  private function _serve($type, $content, $is_file=false)
  {
    header("Content-Type: " . $type);
    if ($is_file)
    {
      readfile($content);
    }
    else
    {
      echo $content;
    }
    Yii::app()->end();
  }

  
}
