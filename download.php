<?php

require "globals.inc.php";

$output = $_SESSION['outputfile'];

// create temporary output file 
$tempFile = $tmpDir . "/" . uniqId('msa');
$output_file = $tempFile . ".aln." . $_SESSION['queryData']['output'];


// Open temporary file and store output
$ff = fopen($output_file, 'wt');
fwrite($ff, $output);
fclose($ff);



//echo $output_file;
//echo file_get_contents($output_file);
header('Content-Type: text/plain');
header("Content-Disposition: attachment; filename=$output_file");
readfile($output_file);

unlink($output_file);

?>
