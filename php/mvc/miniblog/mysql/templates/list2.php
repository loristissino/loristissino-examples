
  <?php foreach($posts as $id=>$content): ?>
  <h1 style="color: red"><?php echo $content['title'] ?></h1>
  <p><?php echo $content['alias'] ?></p>
  <p style="backround-color: yellow"><?php echo $content['introtext'] ?></p>
  <p><?php echo $content['fulltext'] ?></p>
  <hr />
  <?php endforeach ?>
<p>I commenti su questi articoli sono benvenuti.</p>
