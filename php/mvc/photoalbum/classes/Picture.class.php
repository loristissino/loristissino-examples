<?php 

  /* Questa classe rappresenta una singola immagine fotografica
   */
  class Picture
  {
    private $width;
    private $height;
	
    function __construct(PhotoAlbum $photoalbum, $filename)
    {
      // l'immagine deve appartenere ad un determinato PhotoAlbum, specificato
      // come parametro del costruttore
      $this->filename = $filename;
      $this->photoalbum = $photoalbum;
      $this->valid=true;
      $this->storeInfo();
    }

	
    function servePicture()
    {
      // restituisce la fotografia facendo direttamente l'output http
      // prima però controlla se la richiesta viene da una pagina web
      // del nostro sito (grazie al valore "referer" della richiesta
      // del browser
      if(validhost())
      {
        header('Content-Type: ' . $this->getMime());
        readfile($this->getFilepath());
      }
      die('Forbidden access');
    }
    
    function storeInfo()
    {
      // recupera informazioni dal file dell'immagine (larghezza e altezza)
      $info=@getimagesize($this->getFilepath());
      if(!is_array($info))
      {
        $this->valid=false;
      }
      $this->width=$info[0];
      $this->height=$info[1];
      $this->mime=$info['mime'];
    }
    
    function getIsValid()
    {
      return $this->valid;
    }
    
    function getWidth()
    {
      if(!$this->getIsValid())
      {
        throw new Exception('Invalid image');
      }
		  return $this->width;
	  }
    function getHeight()
    {
      if(!$this->getIsValid())
      {
        throw new Exception('Invalid image');
      }
      return $this->height;
	  }
    
    function getMime()
    {
      if(!$this->getIsValid())
      {
        throw new Exception('Invalid image');
      }
      return $this->mime;
    }
	
    function getReducedWidth($scale=false)
    {
      if(false===$scale) $scale=AppConfig::get('photoalbum_preview_reduction', 1);
      return round($this->getWidth()*$scale);
    }
    
    function getReducedHeight($scale=false)
    {
      if(false===$scale) $scale=AppConfig::get('photoalbum_preview_reduction', 1);
      return round($this->getHeight()*$scale);
    }
    
    function getFilepath()
    {
      return $this->photoalbum->getBasepath() . '/'. $this->getFilename();
    }

    function getFilename()
    {
      return $this->filename;
    }
    
    function __toString()
    {
      return $this->filename;
    }

  }
