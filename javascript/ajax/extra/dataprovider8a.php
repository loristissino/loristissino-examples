<?php
    require("../functions.php");

    $id = getUrlValue('id', false);
    
    if ($id) {
        echo json_encode(array('info'=>"Info about room " . $id));
    }
    
