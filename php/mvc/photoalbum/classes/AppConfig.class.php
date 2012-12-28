<?php

class AppConfig
{
   static public function get($key, $default='')
   {
      global $config;
      // usiamo la variabile globale $config (bisogna dichiararla esplicitamente come tale)
      
		  return isset($config[$key]) ? $config[$key] : $default;
      // restituiamo il default se non esiste la voce richiesta nell'array del file di configuraziones
   }
   const a=0.4;
}
