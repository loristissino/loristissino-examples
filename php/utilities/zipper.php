<pre>
<?php

$zip = new ZipArchive();

$zips_dir = "zips"; // nome della directory dove verranno messi i file zip

$filename = $zips_dir . DIRECTORY_SEPARATOR . date("Ymd-his") . ".zip";
// nome del file che verrà creato da questo script

if (!is_dir($zips_dir)) {
// se la directory per i file zip non esiste, creala
	mkdir($zips_dir);
}

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
	// crea il file zip
    exit("cannot open <$filename>\n");
}

echo "File: $filename\n\n";

dirToZip('.'); // chiamata alla funzione (ricorsiva) a partire dalla directory corrente

echo "\n\nReady:\n";
// al termine, mostra il link al file da scaricare
echo "<a href='$filename'>$filename</a>\n\n";

function dirToZip($dir) {
   global $zip;
   global $zips_dir;
  
   $cdir = scandir($dir); // elenco dei file presenti nella directory $dir
   foreach ($cdir as $value)
   {
      if (!in_array($value,array(".",".."))) // saltiamo i riferimenti alla directory corrente
      // e a quella di livello superiore
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {  
            // se si tratta di una directory, chiamata ricorsiva 
            dirToZip($dir . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
         	if (!startsWith($dir, '.' . DIRECTORY_SEPARATOR . $zips_dir)) {
                // salta i file presenti nella directory dove mettiamo i file zip
            	echo "Added:   " . $dir . DIRECTORY_SEPARATOR . $value . "\n";
                // aggiungi il file allo zip
	            $zip->addFile($dir . DIRECTORY_SEPARATOR . $value);
            }
            else {
            	echo "Skipped: " .$dir . DIRECTORY_SEPARATOR . $value . "\n";
            }
         }
      }
   }
}

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}

?>
</pre>
