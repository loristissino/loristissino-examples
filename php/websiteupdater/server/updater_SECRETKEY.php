<?php
	
	$data = json_decode(file_get_contents('php://input'), true);

	foreach($data as $filepath=>$content){
		
		$path_parts = pathinfo($filepath);
		$dir = $path_parts['dirname'];
		$basename = $path_parts['basename'];
		
		if (!is_dir($dir))
		{
			mkdir($dir, 0777, true);
		}
		
		file_put_contents($filepath, $content);
		echo $filepath . "\n";
	}


