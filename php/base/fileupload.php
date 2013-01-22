<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>File upload example</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>

<h1>File upload example</h1>

<?php if(!isset($_FILES['file'])):?>

  <form
    action="<?php echo $_SERVER["PHP_SELF"] ?>"
    method="post"
    enctype="multipart/form-data">
  <div id="fileupload">
  <label for="file">Filename:</label><input type="file" name="file" id="file" /><br />
  <label for="description">Description:</label><input type="text" name="description" id="description" /><br />
  <label for="store"></label><input type="checkbox" name="store" id="store" />store the file<br />
  <input type="submit" name="submit" value="Submit" />
  </div>
  </form>

<?php else: ?>
  <p>Information about the uploaded file:</p>
  <pre>
    <?php print_r($_FILES) ?>
  </pre>
  <p>Description: <?php echo $_POST['description'] ?></p>
  <?php if(isset($_POST['store']) && $_POST['store']=='on' && $_FILES['file']['error']==0): ?>
    <?php
      $newpath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . date('U');
      move_uploaded_file($_FILES["file"]["tmp_name"], $newpath);
    ?>
    <p>File uploaded to: <?php echo $newpath ?></p>
  <?php endif ?>
  <p><a href="<?php echo $_SERVER["PHP_SELF"] ?>">Back to the form</a></p>
<?php endif ?>

</body>
</html>
