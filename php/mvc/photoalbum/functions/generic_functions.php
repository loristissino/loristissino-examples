<?php

 /**
  * Returns the value of the specified parameter from the query string, or the default if the parameter does not exist.
  *
  * @param string $key The name of the parameter.
  * @param string $default The default value.
  * 
  * @return string
  */
  function getParameter($key, $default='')
  {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
  }

 /**
  * Returns TRUE if the specified file is an image, FALSE otherwise.
  *
  * @param string $name The file name.
  * 
  * @return bool
  */
  function is_image($name)
  {
	  if(substr($name, 0, 1)=='.')
	  {
		  return false;
	  }
	  
	  $path_parts = pathinfo($name);
	  if(!in_array(strtolower($path_parts['extension']), array('jpeg', 'png', 'jpg', 'gif')))
	  {
		  return false;
	  }
	  
	  return true;
  }

 /**
  * Returns TRUE if the web request comes from a valid host, as specified in the config file.
  *
  * @return bool
  */
  function validhost()
  {
    if(!AppConfig::get('website_checkreferer', false))
    {
      return true;
    }
    $validhost=AppConfig::get('website_baseurl', false);
    return (isset($_SERVER["HTTP_REFERER"]) and substr($_SERVER["HTTP_REFERER"], 0, strlen($validhost))==$validhost);
  }
  
 /**
  * Returns a string with a valid HTML code for a link.
  *
  * @param string $link The text of the link.
  * @param string $url The URL to link to.
  * @param string $attributes An optional array of attributes to use for the link element.
  * 
  * @return string
  */
  function link_to($link, $url, $attributes=array())
  {
	  $t='<a href="' . $url . '"';
	  foreach($attributes as $name=>$value)
	  {
		 $t .= ' ' . $name . '="' . $value . '"';
	  }
	  $t .= '>' . $link . '</a>';
	  
	  return $t;
  }
