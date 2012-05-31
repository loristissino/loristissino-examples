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

function find_post($value, $by_slug=true)
{
   $conn=getDBConnection();
   if($by_slug)
   {
     $query=sprintf("SELECT id, title, slug, content FROM posts WHERE slug='%s';", $value);
   }
   else
   {
     $query=sprintf("SELECT id, title, slug, content FROM posts WHERE id=%d;", $value);
   }
   $result = $conn->query($query);

   $row = $result->fetch_array();
   if($row)
   {
     $post = array(
       'id'=>$row['id'],
       'title'=>$row['title'],
       'slug'=>$row['slug'],
       'content'=>explode("\n",$row['content'])
       );
   }
   else
   {
     $post = false;
   }
   return $post;

}

function save_post($parameters=array())
{
  $conn=getDBConnection();
  $query=sprintf('INSERT INTO posts (title, slug, content) VALUES ("%s", "%s", "%s")',
    $parameters['title'],
    $parameters['slug'],
    $parameters['content']
    );

  return $conn->query($query); // restituisce vero o falso a seconda che l'inserimento riesca o meno
}

function delete_post($id)
{
  $conn=getDBConnection();
  $query=sprintf('DELETE FROM posts WHERE id = %d', $id);

  return $conn->query($query); // restituisce vero o falso a seconda che l'inserimento riesca o meno
}


// END MODEL


// CONTROLLER
$action=isset($_GET['action'])?$_GET['action']:'list';
// la variabile action assume il valore di default 'list' se nulla è stato indicato nell'URL

$template=$action;
// per default, il nome del template corrisponde a quello dell'azione
// ma potrebbe essere cambiato, come nel caso di documento non esistente

$method=$_SERVER["REQUEST_METHOD"];

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
   case 'delete':
       $id=$_GET['id'];
       if($method=='POST')
       {
         if(delete_post($id))
         {
           $template='delete_success';
           $refresh='?action=list';
         }
         else
         {
           $template='delete_failure';
           $refresh='?action=list';
         }
         break;
       }
       $post=find_post($id, false);
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
   case 'new':
       if($method=='POST')
       {
         if(save_post($_POST))
         {
           $slug=$_POST['slug'];
           $template='new_success';
           $refresh='?action=list';
         }
         else
         {
           $template='new_failure';
           $refresh='?action=list';
         }
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
