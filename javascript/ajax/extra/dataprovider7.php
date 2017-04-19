<?php
    require("../functions.php");
    session_start();
    $base = getSessionValue('base', 0);
    $count = getSessionValue('count', 0);
    
    if (getUrlValue('action', '')=='get')
    {
      echo $base + $count++;
      $_SESSION['count']=$count;
    }
    else if (getUrlValue('action', '')=='update')
    {
      $_SESSION['base']=getPostValue('value', 0);
      echo getSessionValue('base', 0);
    }
