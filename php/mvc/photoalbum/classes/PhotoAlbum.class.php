<?php

  /**
   * An instance of this class represents an album of pictures.
   *
   * @author Loris Tissino <loris.tissino@mattiussilab.net>
   */
  class PhotoAlbum
  {
    // Questa classe rappresenta un album fotografico.
    // Viene istanziata con un valore che specifica la directory in cui 
    // si trovano le fotografie.
    // Questo può essere cambiato una volta che si sposterà la gestione
    // delle fotografie nel database.
    // 


    /**
    * The database handler
    *
    * @var PDO
    */    
    private $dbh;
	  
	  function __construct($basepath)
	  {
		  $this->basepath = $basepath;
      $this->dbh = $GLOBALS['dbh'];
	  }
	  function getPictures()
	  {
      // questa funzione restituisce un array di oggetti di tipo Picture
      // a partire dai dati presenti nella directory di base.
      // potrà essere cambiata nel caso si decida di basarsi sul database
      
		  $list = array_filter(scandir($this->basepath), 'is_image');
		  
		  $result=array(); // inizializziamo un array vuoto per i risultati
		  
		  foreach($list as $name)
		  {
			  $picture = new Picture($this, $name);
			  $result[] = $picture; // aggiungiamo l'oggetto Picture all'array
		  }
		  return $result;
	  }
	  function getBasepath()
	  {
		  return $this->basepath;
	  }
	  
	  function find($filename)
	  {
      // trova una immagine in base al nome del file
      // restituisce False se il file specificato non è un vero
      // file di immagine, l'oggetto Picture se invece lo è
		  $picture = new Picture($this, $filename);
		  if($picture->getIsValid())
		  {
        return $picture;
		  }
		  else
		  {
        return false;
		  }
	  }
	  
	  public function getCategories()
	  {
      // restituisce le categorie, eseguendo una query nel database
      
		  $sql = "SELECT * FROM categories";
		  
		  $result=array();

		  foreach($this->dbh->query($sql, PDO::FETCH_OBJ) as $obj)
		  {
			  $result[]=$obj;
		  }
		  return $result;
	  }
    
  }
