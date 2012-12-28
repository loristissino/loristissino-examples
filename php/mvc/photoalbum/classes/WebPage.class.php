<?php 
  
  /**
   * An instance of this class represents a web page.
   *
   * <code>
   * // example
   * $page = new WebPage();
   * $page->setTitle('Example');
   * echo $page;
   * </code>
   *
   * @author Loris Tissino <loris.tissino@mattiussilab.net>
   */

  class WebPage
  {
    
    /**
    * The title of the page
    *
    * @var string
    */
    private $title;


    /**
     * Creates an instance, optionally with an array of options to override the defaults.
     *
     * @param array $options An array of options in key/value format
     * @access public
     */	
    function __construct($options=array())
    {
      $used_options=array_merge(AppConfig::get('webpage_defaults'), $options);
      // eventuali opzioni passate al momento della creazione dell'istanza
      // vengono armonizzate con quelle presenti nella configurazione di default,
      // specificata nel file di configurazione
      
      $this->setTitle($used_options['title']);
      $this->setTemplate($used_options['template']);
    }
    
    /**
     * Sets a value for the title.
     *
     * @param string $v The title to be set
     */	
    public function setTitle($v)
    {
      $this->title = $v;
    }
    
    public function setTemplate($v)
    {
      $this->template = $v;
    }
    
    /**
     * Returns the content of the page
     *
     * @return string The HTML code of the page
     */	
    public function renderPage()
    {
      // visto che include produce direttamente un output, e questo non
      // ci va bene, lo catturiamo con le funzioni ob_start() e ob_get_clean(),
      // in modo da restituirlo come valore
      ob_start();
      include('templates/layout.php');
      return ob_get_clean();
    }
    
    /**
     * Returns the webpage as a string.
     *
     * @return string The HTML code of the page
     * @see renderPage()
     */	    
    public function __toString()
    {
      // metodo magico
      return $this->renderPage();
    }
	
  }
