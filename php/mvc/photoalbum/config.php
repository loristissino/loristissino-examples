<?php

  // l'array di configurazione globale $config ci permette di memorizzare
  // tutte le informazioni che ci possono essere utili per modificare
  // il comportamento dell'applicazione senza modificare il codice sorgente

	$config['webpage_defaults']=array(
    'title' => 'Senza titolo',
    'template' => 'layout'
  );

	$config['website_baseurl'] = 'http://127.0.0.1/pa/photoalbum';

	$config['website_error'] = '/error.html';
  
  $config['website_checkreferer'] = false;
		
	$config['photoalbum_basepath'] = 'winterpictures';
	$config['photoalbum_preview_reduction'] = 0.4;
	
	$config['db_connection']='mysql:host=localhost; dbname=pa_db';
	$config['db_user']='pa_user';
	$config['db_password']='yB2GcrLcK4dK3faA';
	
// -- non modificare le istruzioni seguenti

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');

// questa funzione serve a far sì che il file contenente il codice di una 
// classe venga automaticamente caricato quando si istanzia un oggetto 
// di quella classe (a patto che il nome del file sorgente sia compatibile
// con uno standard definito, es. 'MiaClasse.class.php')
