<?php
// configurazione
$config['db']['name']='miniblog';
$config['db']['user']='miniblog';
$config['db']['password']='sBGa4YstVRWSPpJB';
$config['db']['server']='localhost';

// MODEL 

function getDBConnection()
{
  global $config;
  static $conn;
  // conviene avere una variabile statica in modo da sfruttare sempre
  // la stessa connessione in ipotetiche query successive
  
  if(!isset($conn))
  {
    $conn = new mysqli(
      $config['db']['server'],
      $config['db']['user'],
      $config['db']['password'],
      $config['db']['name']
      );
  }
  $mysqli_connect_error=mysqli_connect_error();
  if ($mysqli_connect_error)
  {
    die("Connessione al DB fallita: " . $mysqli_connect_error);
  }
  return $conn;
}


function posts_list()
{
   $conn=getDBConnection();
   $posts=array();
   $result = $conn->query("SELECT slug, title FROM posts ORDER BY title;");
   while ($row = $result->fetch_array())
   {
     $posts[$row['slug']]=$row['title'];
   }
   $result->free();
   return $posts;
}

function find_post($slug)
{
   $conn=getDBConnection();
   $query=sprintf("SELECT title, content FROM posts WHERE slug='%s';", $slug);
   $result = $conn->query($query);

   $row = $result->fetch_array();
   if($row)
   {
     $post = array(
       'title'=>$row['title'],
       'content'=>explode("\n",$row['content'])
       );
   }
   else
   {
     $post = false;
   }
   return $post;

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
