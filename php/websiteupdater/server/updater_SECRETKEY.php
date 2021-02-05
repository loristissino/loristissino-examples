<?php
		
	$data = json_decode(file_get_contents('php://input'), true);

	foreach($data as $filepath=>$content){
		
		$path_parts = pathinfo($filepath);
		$dir = $path_parts['dirname'];
		$basename = $path_parts['basename'];
		
		if ($content) {
            if (!is_dir($dir))
            {
                mkdir($dir, 0777, true);
            }
            $result = file_put_contents($filepath, base64_decode($content)) ? '+': 'E';
        }
        else {
            if (file_exists($filepath)) {
                $result = unlink($filepath) ? '-': 'e';
            }
            else {
                $result = '?';
            }
        }
        printf("%s %s\n", $result, $filepath);
	}
