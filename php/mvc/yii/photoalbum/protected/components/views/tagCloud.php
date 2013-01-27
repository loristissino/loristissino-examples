<h2>Tag cloud</h2>
<?php foreach($tags as $tag): $size=rand(5, 12) // just for simulation... ?>
  <?php echo CHtml::tag('span',
    array(
      'class'=>'tag',
      'style'=>'font-size: ' . $size . 'pt'
    ),
    CHtml::link(
      CHtml::encode($tag), 
      array('tag/show', 'id'=>$tag->id)
      )
    ) ?>
<?php endforeach ?>
