<?php
// configurazione
$config['directory']='posts_87dHJD-kmsh';

// MODEL 

function post_exists($slug)
{
  global $config;
  $path=get_path($slug);
  if(!file_exists($path) or !is_dir($path) or !is_readable($path))
  {
    return false;
  }
  return true;
  // assumiamo che esistano i file title.txt e content.txt nella directory
}

function get_path($slug)
{
  global $config;
  return sprintf('%s/%s', $config['directory'], $slug);
}

function get_title($slug)
{
  global $config;
  return implode('', file(sprintf('%s/title.txt', get_path($slug))));
   // assumiamo che il titolo sia nel file 'title.txt'
   // leggiamo il file di testo in un array (funzione file())
   // uniamo tutti gli elementi dell'array in un'unica stringa (funzione implode())
}

function get_content($slug)
{
  global $config;
  return file(sprintf('%s/content.txt', get_path($slug)));
}

function posts_list()
{
   global $config;
   $posts=array();
   $files=scandir($config['directory']);
   foreach($files as $file)
   {
     $path=get_path($file);
     if((is_dir($path)) and (substr($file,0,1)!='.'))
     {
       $posts[$file]=get_title($file);
     }
   }
   return $posts;
}

function find_post($slug)
{
  global $config;

  if(post_exists($slug))
  {
    return array(
      'title'=>get_title($slug),
      'content'=>get_content($slug)
      );
  }
  else
  {
    return false;
  }
}
// END MODEL


// CONTROLLER
$action=isset($_GET['action'])?$_GET['action']:'list';
// la variabile action assume il valore di default 'list' se nulla è stato indicato nell'URL

$template=$action;
// per default, il nome del template corrisponde a quello dell'azione
// ma potrebbe essere cambiato, come nel caso di documento non esistente

switch ($action)
{
   case 'list':
       $title='Elenco contenuti';
       $posts=posts_list();
       break;
   case 'show':
       $slug=$_GET['slug'];
       $post=find_post($slug);
       if ($post)
       {
         $title=$post['title'];
       }
       else
       {
         $title='Documento inesistente';
         $template='filenotfound';
       }
       break;
   default:
       $title='Azione non consentita';
       $template='error';
}
// END CONTROLLER

// VIEW
?>
<?php include('templates/layout.php') //END VIEW ?>
