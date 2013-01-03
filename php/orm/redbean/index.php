<?php

// see http://www.redbeanphp.com/
// see http://www.cs.wcupa.edu/~rkline/php/redbean-orm.html

include('_header.php');
require('auxiliary_functions.php');
require('rb.php');

define('EC', '#009900');

class Custom_SimpleModel extends RedBean_SimpleModel
{
  public function save()
  {
    R::store($this);
  }
  
  public static function quotevalue(&$value, $key, $db)
  {
  $value=$db->quote($value); 
  }
  
}

class Model_Picture extends Custom_SimpleModel
{
  public function aboutMe()
  {
    echo "Hello!\n";
    echo "My class is " . get_class($this) . "\n";
  }
  
  public function update()
  {
    // This is automatically called when the object is stored
    $supported_types=array('jpeg', 'gif', 'png');
    if(!in_array($this->type, $supported_types))
    {
      throw new Exception('Supported types are only: ' . implode(', ', $supported_types));
    }
  }
  
}


class Model_Category extends Custom_SimpleModel
{
  
}

heading(1, 'Some experiments with RedBeanPhp');

$user="oodb";
$pass="xZmjYf7KyGCBt5Mb";
$db="oodb";

heading(2, 'Setting up the db...');

R::setup("mysql:host=localhost;dbname=" . $db, $user, $pass);

comment('DB connection established', __LINE__);

R::nuke(); // this deletes everything!

comment('DB erased', __LINE__);

heading(2, 'Categories creation and storing');

foreach(array(
  'Art',
  'History',
  'Cinema',
  'Environment',
  ) as $value)
{
  $category = R::dispense('category');
  $category->name=$value;
  $id = R::store($category);
  comment("OK - Stored category $category", __LINE__);
}

heading(2, 'Pictures creation and storing');

comment('One picture will not be stored because of its unsupported type.', null, EC);
comment('An exception will be thrown.', null, EC);

foreach(array(
  array('jpeg', 'Beautiful place in the Alps', 480, 640),
  array('jpeg', 'An old castle in Wales', 640, 480),
  array('jpeg', 'Tears of Steel', 200, 800),
  array('tiff', 'A picture sent by a colleague', 1200, 900),
  array('gif', 'Big Buck Bunny', 400, 300),
  array('png', "Latin America's Iguazu waterfalls", 500, 600),
  array('jpeg', "Napoleon's portrait", 200, 300),
  array('jpeg', "Garibaldi's portrait", 200, 300),
  ) as $item)
{
  $picture = R::dispense('picture');
  list($picture->type, $picture->description, $picture->width, $picture->height) = $item;
  try
  {
    $id = R::store($picture);
    comment ("OK - Stored picture: $picture", __LINE__);
  }
  catch(Exception $e)
  {
    comment (sprintf("FAILED - Could not store picture $picture: got Exception «%s»\n",  $e->getMessage()), __LINE__);
  }
}

heading(2, 'Finding objects');

$c_hist = R::findOne('category', 'name = ?', array('History'));

comment ("OK - Found category from name: $category", __LINE__);

$p = R::findOne('picture', 'description = ?', array('An old castle in Wales'));

comment ("OK - Found picture from description: $p", __LINE__);

heading(2, 'Managing one-to-many relationships');

$p->category = $c_hist;
R::store($p);
comment ("OK - Updated picture with category: $p", __LINE__);

$descriptions=array(
  'Beautiful place in the Alps',
  "Latin America's Iguazu waterfalls",
  );
$c_env = R::findOne('category', 'name = ?', array('Environment'));

$somepictures = R::find('picture', 'description in (' .R::genSlots($descriptions).') ', $descriptions);

comment('Here we will update some rows with a loop', null, EC);

foreach($somepictures as $p)
{
  $p->category = $c_env;
  R::store($p);
  comment ("OK - Updated picture setting category: $p", __LINE__);
}

$c_hist = R::findOne('category', 'name = ?', array('History'));

comment('Here we will write our UPDATE query using basic PDO prepared statements', null, EC);

$db = R::getDatabaseAdapter()->getDatabase()->getPDO();

$descriptions=array(
  "Napoleon's portrait",
  "Garibaldi's portrait",
);

array_walk($descriptions, array('Custom_SimpleModel', 'quotevalue'), $db);

$stmt = $db->prepare(
  'UPDATE picture SET category_id = ? WHERE description in ( ' . implode(', ', $descriptions) . ')'
  );
$stmt->bindParam(1, $c_hist->id);
$stmt->execute();

comment('OK - Updated historical pictures (with a prepared statement)', __LINE__);

comment('Here we will use the own* property', null, EC);

$c_cinema = R::findOne('category', 'name = ?', array('Cinema'));

$p1 = R::load('picture', 3);
$p2 = R::load('picture', 4);
comment("OK - Loaded pictures using known ids", __LINE__);

$c_cinema->ownPicture = array($p1, $p2);

comment("OK - Set 'ownership'", __LINE__);
R::store($c_cinema);
comment("OK - Stored objects", __LINE__);

comment("How to retrieve 'owned' objects", null, EC);

foreach($c_hist->ownPicture as $p)
{
  comment("Picture $p", __LINE__);
}

heading(2, 'Managing many-to-many relationships');

comment("Let's start by creating some people's records", null, EC);

foreach(array(
  'Alice',
  'Bob',
  'Charlie',
  'Donna',
) as $item)
{
  $person = R::dispense('person');
  $person->name = $item;
  R::store($person);
  comment("OK - Stored person $person", __LINE__);
}

$picture1=R::load('picture', 1);
$picture2=R::load('picture', 2);
$picture3=R::load('picture', 3);
$person2=R::load('person', 2);
$person3=R::load('person', 3);

$picture1->sharedPerson[] = $person2;
$picture1->sharedPerson[] = $person3;

$picture2->sharedPerson[] = $person2;
comment("OK - Set information as shared for pictures", __LINE__);

R::store($picture1);
R::store($picture2);

comment("Let's list persons connected to picture 1:", null, EC);

foreach($picture1->sharedPerson as $p)
{
  comment("Person $p", __LINE__);
}

comment("Let's list pictures connected to person 2:", null, EC);

foreach($person2->sharedPicture as $p)
{
  comment("Picture $p", __LINE__);
}

heading(2, 'Tagging');

comment('Tags are special many-to-many information pieces associated automatically with different kinds of objects.', null, EC);
comment('We do not need to store them explicitly.', null, EC);

R::tag($picture1, array('Tolmezzo', 'Alpi', 'Tagliamento', 'beautiful sky'));
R::tag($picture2, array('Dolwyddelan', 'Llywelyn ap Iorwerth', 'beautiful sky'));
R::tag($picture3, array('blender'));
comment('Stored tags for some pictures', __LINE__);

comment('We can retrieve all the pictures that share the tag «beautiful sky»:', null, EC);
foreach(R::tagged('picture', array('beautiful sky')) as $p)
{
  comment("Picture $p", __LINE__);
}

comment('We can retrieve all the pictures that share the tag «blender»', null, EC);
foreach(R::tagged('picture', array('blender')) as $p)
{
  comment("Picture $p", __LINE__);
}

include('_footer.php');
