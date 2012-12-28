<?php

  /* questo è il punto di avvio dell'applicazione
   */

  require_once('config.php');  // inclusione del file di configurazione
  require_once('functions/generic_functions.php');  // inclusione di un file di funzioni
 
  $webpage = new WebPage(array('title'=>'Album fotografico')); // creazione di un'istanza della classe WebPage
  
  try
  {
    $dbh = new PDO(AppConfig::get('db_connection'), AppConfig::get('db_user'), AppConfig::get('db_password'));
    // creazione di un'istanza di PDO per l'accesso alla base di dati
    // per l'accesso ai dati del file di configurazione si usa la funzione statica della classe AppConfig,
    // di cui non serve creare un'istanza
  }
  catch (Exception $e)
  {
    header('Location: ' . AppConfig::get('website_baseurl') . AppConfig::get('website_error'));
    // nel caso la connessione al DB non sia possibile, rendirizziamo ad una pagina web specificata nel file di configurazione
  }

  $action=getParameter('action', 'list');
  // vediamo qual è l'azione richiesta nell'url
  // index.php?action=foo significherebbe che l'azione è "foo"
  // nel caso di valore mancante, viene preso il default (in questo caso "list")
  
  $template=$action;
  // il template da usare, salvo diversa specificazione, ha un nome che corrisponde all'azione
  
  switch($action)
  {
    // a seconda dell'azione richiesta, eseguiamo l'operazione desiderata
    // questo è il vero e proprio "controller"
	  case 'list':
	     $photoalbum = new PhotoAlbum(AppConfig::get('photoalbum_basepath'));
	     $webpage->pictures = $photoalbum->getPictures();
	     $webpage->categories = $photoalbum->getCategories();
	     break;
	  case 'filterbycategory':
	     $photoalbum = new PhotoAlbum(AppConfig::get('photoalbum_basepath'));
	     $webpage->pictures = $photoalbum->getPictures();
	     $template='list';
	     $webpage->categories = $photoalbum->getCategories();
	     break;
	  case 'preview':
	     $photoalbum = new PhotoAlbum(AppConfig::get('photoalbum_basepath'));
	     $webpage->pictures = $photoalbum->getPictures();
	     break;
	  case 'serve':
	     $photoalbum = new PhotoAlbum(AppConfig::get('photoalbum_basepath'));
	     if(false !== $picture=$photoalbum->find(getParameter('file')))
	     {
          $picture->servePicture();
       }
       else
       {
			   $template='error';
			   $webpage->message='File non trovato.';
		   }
	     break;
	  case 'show':
	     $photoalbum = new PhotoAlbum(AppConfig::get('photoalbum_basepath'));
	     if(false === $webpage->picture = $photoalbum->find(getParameter('file')))
	     {
          $template='error'; 
          $webpage->message='File non trovato.';
       }
	     break;
	  default:
	     $template='error';
	     $webpage->message='Azione non consentita.';
  }

  $webpage->setTemplate($template);
  // impostiamo il template specificato
  
  echo $webpage;
  // mostriamo la pagina web, sfruttando il "magic method" __toString() della classe WebPage
  // altrimenti, avremmo dovuto richiamare esplicitamente
  // echo $webpage->renderPage()
