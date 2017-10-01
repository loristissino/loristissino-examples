<?php
    $rooms = array(
        array('id'=> 10, 'name'=>'Room A', 'sizex'=>10, 'sizey'=>7,  'posx'=>0,  'posy'=>0,  'color'=>'#FFA500'),
        array('id'=> 11, 'name'=>'Room B', 'sizex'=>10, 'sizey'=>7,  'posx'=>10, 'posy'=>0,  'color'=>'#90EE90'),
        array('id'=> 12, 'name'=>'Room C', 'sizex'=>20, 'sizey'=>5,  'posx'=>0,  'posy'=>7,  'color'=>'#FFFFFF'),
        array('id'=> 13, 'name'=>'Room D', 'sizex'=>20, 'sizey'=>15, 'posx'=>0,  'posy'=>12, 'color'=>'#FFC0CB'),
        array('id'=> 14, 'name'=>'Room E', 'sizex'=>5,  'sizey'=>5,  'posx'=>20, 'posy'=>22, 'color'=>'#FFFF00'),
    );
    
    echo json_encode($rooms);
