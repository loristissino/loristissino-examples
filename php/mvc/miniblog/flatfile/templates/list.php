<h2>Informazioni</h2>
<p>Sono disponibili <?php echo sizeof($posts) ?> articoli.</p>

<h2>Elenco</h2>
<ul>
  <?php foreach($posts as $slug=>$title): ?>
    <li><a href="?action=show&slug=<?php echo $slug ?>"><?php echo $title ?></a></li>
  <?php endforeach ?>
</ul>
<p>I commenti su questi articoli sono benvenuti.</p>
