<?php 

  /* Questa classe rappresenta una pagina web, in cui si possono impostare
   * dei valori per il titolo, il template da usare, ecc. e fare l'output.
   * È solo un abbozzo, il codice può essere integrato a seconda delle 
   * esigenze...
   */

  class WebPage
  {
	
    function __construct($options=array())
    {
      $used_options=array_merge(AppConfig::get('webpage_defaults'), $options);
      // eventuali opzioni passate al momento della creazione dell'istanza
      // vengono armonizzate con quelle presenti nella configurazione di default,
      // specificata nel file di configurazione
      
      $this->setTitle($used_options['title']);
      $this->setTemplate($used_options['template']);
    }
    
    function setTitle($v)
    {
      $this->title = $v;
    }
    
    function setTemplate($v)
    {
      $this->template = $v;
    }
    
    function renderPage()
    {
      // visto che include produce direttamente un output, e questo non
      // ci va bene, lo catturiamo con le funzioni ob_start() e ob_get_clean(),
      // in modo da restituirlo come valore
      ob_start();
      include('templates/layout.php');
      return ob_get_clean();
    }
    
    function __toString()
    {
      // metodo magico
      return $this->renderPage();
    }
	
  }
