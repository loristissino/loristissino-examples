<?php

  function getParameter($key, $default='')
  {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
  }

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

  function validhost()
  {
    if(!AppConfig::get('website_checkreferer', false))
    {
      return true;
    }
    $validhost=AppConfig::get('website_baseurl', false);
    return (isset($_SERVER["HTTP_REFERER"]) and substr($_SERVER["HTTP_REFERER"], 0, strlen($validhost))==$validhost);
  }
  
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
